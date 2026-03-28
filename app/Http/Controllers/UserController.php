<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->byRole($request->role);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->inactive();
            }
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Add success message if exists in session
        if ($request->session()->has('success')) {
            $message = $request->session()->get('success');
            $messageType = 'success';
        } elseif ($request->session()->has('error')) {
            $message = $request->session()->get('error');
            $messageType = 'danger';
        } else {
            $message = '';
            $messageType = '';
        }

        return view('users.index', compact('users', 'message', 'messageType'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['ADMIN', 'SUPERVISEUR', 'SOUSTRAITANT'])],
        ], [
            'nom.required' => 'Le nom est requis',
            'prenom.required' => 'Le prénom est requis',
            'email.required' => 'L\'email est requis',
            'email.email' => 'Format d\'email invalide',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
            'role.required' => 'Le rôle est requis',
            'role.in' => 'Le rôle sélectionné est invalide',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', implode('<br>', $validator->errors()->all()));
        }

        try {
            DB::beginTransaction();

            // Création de l'utilisateur
            $user = new User();
            $user->id = User::generateId();
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->telephone = $request->telephone;
            $user->email = $request->email;
            $user->password_hash = Hash::make($request->password);
            $user->role = $request->role;
            $user->actif = true;
            $user->save();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'Utilisateur ajouté avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // Validation des données
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'telephone' => 'nullable|string|max:20',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id)
                ],
                'new_password' => 'nullable|string|min:6',
                'role' => ['required', Rule::in(['ADMIN', 'SUPERVISEUR', 'SOUSTRAITANT'])],
                'actif' => 'nullable|boolean'
            ], [
                'nom.required' => 'Le nom est requis',
                'prenom.required' => 'Le prénom est requis',
                'email.required' => 'L\'email est requis',
                'email.email' => 'Format d\'email invalide',
                'email.unique' => 'Cet email est déjà utilisé',
                'new_password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
                'role.required' => 'Le rôle est requis',
                'role.in' => 'Le rôle sélectionné est invalide',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', implode('<br>', $validator->errors()->all()));
            }

            DB::beginTransaction();

            // Mise à jour des informations
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->telephone = $request->telephone;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->actif = $request->has('actif') ? 1 : 0;

            // Mise à jour du mot de passe si fourni
            if ($request->filled('new_password')) {
                $user->password_hash = Hash::make($request->new_password);
            }

            $user->save();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'Utilisateur modifié avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            
            // Vérifier si l'utilisateur n'est pas en cours d'utilisation
            // Vous pouvez ajouter des vérifications supplémentaires ici
            
            $user->delete();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'Utilisateur supprimé avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Toggle user status (activate/deactivate).
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->actif = !$user->actif;
            $user->save();

            DB::commit();

            $message = $user->actif ? 'Utilisateur activé avec succès !' : 'Utilisateur désactivé avec succès !';
            return redirect()->route('users.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erreur lors du changement de statut : ' . $e->getMessage());
        }
    }

    /**
     * Bulk delete users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Sélection invalide');
        }

        try {
            DB::beginTransaction();

            User::whereIn('id', $request->user_ids)->delete();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', count($request->user_ids) . ' utilisateur(s) supprimé(s) avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Export users to CSV.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && $request->role) {
            $query->byRole($request->role);
        }

        $users = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="utilisateurs_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, ['ID', 'Nom', 'Prénom', 'Email', 'Téléphone', 'Rôle', 'Statut', 'Date création']);
            
            // Data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->nom,
                    $user->prenom,
                    $user->email,
                    $user->telephone,
                    $user->role_label,
                    $user->status_label,
                    $user->created_at->format('d/m/Y H:i')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}