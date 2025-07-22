<div class="tutorial-card {{ $type }}">
    <div class="icon-block">
        @if($type === 'video')
            <i class="fas fa-video"></i>
        @elseif($type === 'pdf')
            <i class="fas fa-file-pdf"></i>
        @elseif($type === 'blog')
            <i class="fas fa-pen-alt"></i>
        @endif
    </div>
    <div class="content-block">
        <div class="card-header">
            <span class="badge {{ $type }}">{{ strtoupper($type) }}</span>
            <h3>{{ $title }}</h3>
        </div>
        <p class="description">{{ $description }}</p>
        <div class="card-footer">
            <a href="{{ $link }}" class="btn-view">Voir</a>
        </div>
    </div>
</div>
