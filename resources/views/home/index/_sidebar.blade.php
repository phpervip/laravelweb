<div class="card mt-2 md-2">
      <div class="card-body">
        <div class="text-center mt-1 mb-0 text-muted">最新资讯</div>
        <hr class="mt-2">
        @foreach ($news as $item)
          <a class="media mt-2" href="{{ route('news.show', $item->id) }}">
            <div class="media-body">
              <small class="media-heading text-secondary">{{ $item->title }}</small>
            </div>
          </a>
        @endforeach
      </div>
</div>
