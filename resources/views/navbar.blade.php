<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navissima" aria-controls="navissima" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link{{ $page == 'riders'? ' active' : '' }}" aria-current="page" href="{{ route('rider.list', ['bandId' => $band->id]) }}">Fiches techniques</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ $page == 'members'? ' active' : '' }}" href="{{ route('members.list', ['bandId' => $band->id]) }}">Membres du groupe</a>
            </li>
        </ul>
    </div>
</nav>