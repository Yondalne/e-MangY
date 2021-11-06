<div class="tableUser" style="color: white">
    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Mail</th>
                <th>Date de Naissance</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allUser as $currentUser )
                @if ($currentUser->admin == 1)
                    @continue
                @endif
                <tr>
                    <td>{{$currentUser->pseudo}}</td>
                    <td>{{$currentUser->name}}</td>
                    <td>{{$currentUser->second_name}}</td>
                    <td>{{$currentUser->mail}}</td>
                    <td>{{$currentUser->date_nais}}</td>
                    <td>
                        <a href="" wire:click='banHammer({{$currentUser->id}})' wire:click="$refresh">
                            @if ($currentUser->isBan == 1)
                                Debannir
                            @else
                                Bannir
                            @endif
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            {{-- {{$allUSer->links('components.user.dashboard.pagination')}} --}}
        </tfoot>
    </table>
</div>
