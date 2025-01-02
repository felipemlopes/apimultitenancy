<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Nome
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="{{($edit and $user)?$user->name:old('name')}}">
    @error('name')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        E-mail
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" value="{{($edit and $user)?$user->email:old('email')}}">
    @error('email')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
@if(!$edit)
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Senha
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="text" value="{{old('password')}}">
    @error('password')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
@endif
