<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Nome
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="{{($edit and $site)?$site->name:old('name')}}">
    @error('name')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        DB connection
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="db_connection" name="db_connection" type="text" value="{{($edit and $site)?$site->db_connection:old('db_connection')}}">
    @error('db_connection')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        DB name
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="db_name" name="db_name" type="text" value="{{($edit and $site)?$site->db_name:old('db_name')}}">
    @error('db_name')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        DB user
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="db_user" name="db_user" type="text" value="{{($edit and $site)?$site->db_user:old('db_user')}}">
    @error('db_user')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        DB password
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="db_password" name="db_password" type="text" value="{{($edit and $site)?$site->db_password:old('db_password')}}">
    @error('db_password')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        DB host
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="db_host" name="db_host" type="text" value="{{($edit and $site)?$site->db_host:old('db_host')}}">
    @error('db_host')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        DB host
    </label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="db_port" name="db_port" type="text" value="{{($edit and $site)?$site->db_port:old('db_port')}}">
    @error('db_port')
    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
