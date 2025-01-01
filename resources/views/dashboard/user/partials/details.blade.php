<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Nome
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="{{($edit and $user)?$user->name:old('name')}}">
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        E-mail
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" value="{{($edit and $user)?$user->email:old('email')}}">
</div>
@if(!$edit)
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Senha
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="text" value="{{old('password')}}">
</div>
@endif
