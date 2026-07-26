<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-white p-6 sm:p-12">
  <div
    class="w-full max-w-md sm:max-w-lg p-8 sm:p-10 rounded-2xl shadow-lg"
  >
    <!-- Logo -->
    <div class="mb-8 flex justify-center">
      <a href="/" wire:navigate>
        <img src="/images/logo_smp12yk.png" alt="Logo" class="h-16 sm:h-20 w-auto" />
      </a>
    </div>

    <!-- Informasi -->
    <div class="mb-6 text-sm sm:text-base text-gray-600">
      {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form wire:submit.prevent="sendPasswordResetLink" class="flex flex-col">
      <!-- Email Address -->
      <div>
        <x-input-label for="email" :value="__('Email')" class="text-sm sm:text-base" />
        <x-text-input
          wire:model="email"
          id="email"
          class="block mt-1 w-full text-sm sm:text-base"
          type="email"
          name="email"
          required
          autofocus
        />
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs sm:text-sm" />
      </div>

      <!-- Submit Button -->
      <div class="mt-6 flex justify-center">
        <x-primary-button class="w-full text-sm sm:text-base">
          {{ __('Email Password Reset Link') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</div>

