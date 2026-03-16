<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $role = $request->query('role');
        $status = $request->query('status');

        $users = User::query()
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->where('name', 'like', "%{$query}%")
                        ->orWhere('username', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%");
                });
            })
            ->when($role, fn ($builder) => $builder->where('role', $role))
            ->when($status, fn ($builder) => $builder->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'query', 'role', 'status'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if (auth()->id() === $user->id) {
            if ($validated['status'] === 'disabled') {
                return redirect()
                    ->route('admin.users.edit', $user)
                    ->with('error', 'You cannot disable your own account.');
            }

            if ($validated['role'] !== 'admin') {
                return redirect()
                    ->route('admin.users.edit', $user)
                    ->with('error', 'You cannot remove your own admin role.');
            }
        }

        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'bio' => $validated['bio'] ?? null,
            'website' => $validated['website'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'twitter' => $validated['twitter'] ?? null,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function disable(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot disable your own account.');
        }

        $user->update([
            'status' => 'disabled',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User disabled successfully.');
    }

    public function enable(User $user)
    {
        $user->update([
            'status' => 'active',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User enabled successfully.');
    }
}