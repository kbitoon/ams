<?php

namespace App\Livewire\Profile;

use App\Models\ReliefDistribution;
use App\Models\Family;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ReliefAssistance extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $user = auth()->user();
        
        // Get individual distributions for this user
        $individualDistributions = ReliefDistribution::with([
            'reliefOperation',
            'reliefItem.reliefType',
            'distributor'
        ])
        ->where('distribution_type', 'individual')
        ->where('user_id', $user->id)
        ->orderBy('distributed_at', 'desc')
        ->get();

        // Get family distributions where user is head of family
        $familiesAsHead = Family::where('head_of_family_id', $user->id)->pluck('id');
        $familyDistributionsAsHead = ReliefDistribution::with([
            'reliefOperation',
            'reliefItem.reliefType',
            'family',
            'distributor'
        ])
        ->where('distribution_type', 'family')
        ->whereIn('family_id', $familiesAsHead)
        ->orderBy('distributed_at', 'desc')
        ->get();

        // Get family distributions where user is a member (but not head) OR where user was the representative
        $familyMemberships = $user->familyMemberships()->pluck('family_id');
        $familyDistributionsAsMember = ReliefDistribution::with([
            'reliefOperation',
            'reliefItem.reliefType',
            'family.headOfFamily',
            'distributor'
        ])
        ->where('distribution_type', 'family')
        ->where(function($query) use ($familyMemberships, $familiesAsHead, $user) {
            // User is a member of the family (but not head)
            $query->where(function($q) use ($familyMemberships, $familiesAsHead) {
                $q->whereIn('family_id', $familyMemberships)
                  ->whereNotIn('family_id', $familiesAsHead);
            })
            // OR user was the representative who received the goods (but not for families where user is head - already included above)
            ->orWhere(function($q) use ($user, $familiesAsHead) {
                $q->where('user_id', $user->id)
                  ->whereNotIn('family_id', $familiesAsHead);
            });
        })
        ->orderBy('distributed_at', 'desc')
        ->get();

        // Combine all family distributions and remove duplicates
        $familyDistributions = $familyDistributionsAsHead->merge($familyDistributionsAsMember)
            ->unique('id')
            ->sortByDesc('distributed_at')
            ->values();

        return view('livewire.profile.relief-assistance', [
            'individualDistributions' => $individualDistributions,
            'familyDistributions' => $familyDistributions,
        ]);
    }
}

