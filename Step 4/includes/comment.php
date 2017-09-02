<div class="comment-wrapper">
  <div class="comment-header">
    <h2>Posted by
      <span class="comment-name"><?php echo $row["comment_name"]; ?></span> at
      <span class="comment-date"><?php echo $row["comment_time"]; ?></span>
    </h2>
  </div>

  <div class="comment-body">
    <p><?php echo $row["comment_body"]; ?></p>
  </div>
</div>
