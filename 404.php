<?php get_header(); ?>

<section class="error-section">
  <h1>
    <span class="num">404</span>
    <span class="en">Not Found</span>
  </h1>
  <div class="detail">
    <p class="read">ご指定のページが見つかりませんでした。</p>
    <p class="text">アクセスしようとしたページは削除、変更されたか、現在利用できない可能性があります。</p>
  </div>
  <div class="linkButton">
    <a href="<?php echo esc_url(home_url()); ?>/">トップページへ戻る</a>
  </div>
</section>

<?php get_footer(); ?>


