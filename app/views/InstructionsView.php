<div class="post-wrap">

    <?php foreach ($instructionsData as $instruction) : ?>
      <div class="post-item">
        <div class="post-item-wrap">
          <div class="post-title">
            <?php echo $instruction['header']; ?>
          </div>
          <div class="text-wrapper-block">
            <div class="text-wrapper">
              <a href="/instruction/<?php echo $instruction['id']; ?>" class="post-link">
                <p class="theme"><?php echo $instruction['theme']; ?></p>
                <p class="details">Нажмите, чтобы открыть</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <script>
      window.onload = () => {
        showInstructions();
      }
    </script>
   
</div>