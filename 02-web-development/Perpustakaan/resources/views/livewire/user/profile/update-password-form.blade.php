<div>
    {{-- Current Password --}}
    <div>
        <x-input-label for="current_password" :value="('Password Saat Ini')" />
        <div class="relative">
            <input
                id="current_password"
                type="password"
                wire:model="current_password"
                class="block mt-1 w-full text-sm pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="current_password"
                required
                autocomplete="current-password"
            />
            <button type="button" onclick="togglePassword('current_password', 'eyeIcon_current')"
                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg id="eyeIcon_current" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('current_password')" class="mt-1 text-xs" />
    </div>

    {{-- New Password --}}
    <div class="mt-4">
        <x-input-label for="new_password" :value="('Password Baru')" />
        <div class="relative">
            <input
                id="new_password"
                type="password"
                wire:model="new_password"
                class="block mt-1 w-full text-sm pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="new_password"
                required
                autocomplete="new-password"
            />
            <button type="button" onclick="togglePassword('new_password', 'eyeIcon_new')"
                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg id="eyeIcon_new" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('new_password')" class="mt-1 text-xs" />
    </div>

    {{-- Confirm Password --}}
    <div class="mt-4">
        <x-input-label for="confirm_password" :value="('Konfirmasi Password')" />
        <div class="relative">
            <input
                id="confirm_password"
                type="password"
                wire:model="confirm_password"
                class="block mt-1 w-full text-sm pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="confirm_password"
                required
                autocomplete="new-password"
            />
            <button type="button" onclick="togglePassword('confirm_password', 'eyeIcon_confirm')"
                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg id="eyeIcon_confirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('confirm_password')" class="mt-1 text-xs" />
    </div>

    {{-- Submit Button --}}
    <div class="flex justify-end mt-6">
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-5 py-2 rounded-md shadow-sm transition">
            Simpan Perubahan
        </button>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.add('text-blue-500');
    } else {
        input.type = "password";
        icon.classList.remove('text-blue-500');
    }
}
</script>
