<x-base>
<h1 class="text-center font-bold pb-6 text-5xl">Usuários</h1>

    <a class="font-bold text-decoration-line: underline" href="{{route('users.create')}}">Novo</a>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>-</td>
            </tr>
            @empty
            <tr>
                <td colspan="100">Nenhum usuário no banco</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$users->links()}}

</x-base>