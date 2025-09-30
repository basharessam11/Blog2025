<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
    <channel>
        <title>مدونة موقعك - آخر الأخبار</title>
        <link>{{ url('/') }}/btolat/news</link>
        <description>آخر أخبار الرياضة من مدونتك</description>
        <language>ar</language>
        @foreach ($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>{{ url('/btolat/news/' . $post->slug) }}</link>
                <guid>{{ url('/btolat/news/' . $post->slug) }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
                <description>
                    <![CDATA[{!! $post->content !!}]]>
                </description>
            </item>
        @endforeach
    </channel>
</rss>
