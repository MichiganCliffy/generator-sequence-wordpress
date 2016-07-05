<form action="/" role="search">
  <div class="input-group">
    <input type="text" name="s" class="form-control" placeholder="Search" value="<?php the_search_query(); ?>" />
    <span class="input-group-btn">
      <button type="submit" class="btn btn-default">Go!</button>
    </span>
  </div>
</form>