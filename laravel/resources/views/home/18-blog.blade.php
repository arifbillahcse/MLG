<!-- ═══════════════ 12 · BLOG ═══════════════ -->
<section class="section" id="blog">
  <div class="wrap">
    <header class="sec-head reveal">
      <p class="eyebrow">Resources</p>
      <h2 data-en="Read before you decide" data-bn="সিদ্ধান্ত নেওয়ার আগে পড়ুন">Read before you decide</h2>
    </header>

    <div class="posts">
      @foreach ($posts as $i => $post)
      <article class="post reveal" data-delay="{{ $i + 1 }}">
        <div class="post__thumb post__thumb--{{ $post->thumb_variant ?: '1' }}"
             @if ($post->thumbnail) style="background-image:url('{{ asset('storage/'.$post->thumbnail) }}');background-size:cover" @endif>
          <span class="post__cat">{{ $post->category?->name }}</span>
        </div>
        <h3><a href="{{ route('blog') }}">{{ $post->title }}</a></h3>
        <p class="post__meta mono">{{ $post->read_minutes }} min read · {{ $post->category?->name }}</p>
      </article>
      @endforeach
    </div>
  </div>
</section>
