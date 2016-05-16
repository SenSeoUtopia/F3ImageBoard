<div id="content" class="clearfix clear">
<div class="boards clearfix clear">
<h1>What is ?</h1>
<p></p>
</div>
<div class="boards clearfix clear">
<h1>Boards</h1>

<repeat group="{{ @category_list }}" value="{{@board_list}}">

<div class="column">
<h1>{{ @board_list.name}}</h1>

<ul>
<li>
<a href="{{ @home_url }}/{{ @board_list.boards.slug }}">{{ @board_list.boards.name }}</a>
</li>
</ul>
</div>

</repeat>


</div>
<div class="left-column">
<include href="widgets/recent_photos.htm"/>
</div>

<div class="right-column">
<include href="widgets/recent_posts.htm" with="posts_list = {{ @post_list }}" />
<include href="widgets/popular_threads.htm" with="{{ @thread_list }}" />
<include href="widgets/stats.htm" with="total_size = {{ @page.total_size }}" />
</div>
</div>