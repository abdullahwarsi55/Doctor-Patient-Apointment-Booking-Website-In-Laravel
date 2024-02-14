<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 style="font-size: 20px"><strong><center>Patient Registration Form</center></strong></h1>
            <center><a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('registerdoctor.create') }}">
                {{ __('Register as a Doctor') }}
            </a></center>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
             <select class="block mt-1 w-full" id="gender" name="gender"> 
            <option value="Male">Male </option>
            <option value="Female">Female</option>
    </select>
        </div>

        <div>
            <x-input-label for="phonenumber" :value="__('Phone Number')" />
            <x-text-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" :value="old('phonenumber')" required autofocus autocomplete="phonenumber" />

        </div>
        <div>
            <x-input-label for="blooadtype" :value="__('Blood Type')" />
            <x-text-input id="bloodtype" class="block mt-1 w-full" type="text" name="bloodtype" :value="old('bloodtype')" required autofocus autocomplete="bloodtype" />

        </div>
        <div>
            <x-text-input   id="usertype"  type="text"  name="usertype" value="2"   autocomplete="usertype"  hidden />

        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
