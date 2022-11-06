<div class="sample">
  <div class="sample-container">
  <fieldset>
    <legend>Инструкция</legend>
    <label class="head-sample">Название: </label>
    <div class="head-sample-text-block">
      <p class = "name"><?php echo $instruction_data['header']; ?></p>
    </div>
    <label class="about-sample">Тема</label>
    <div class="about-sample-text-block">
      <p class="theme"><?php echo $instruction_data['theme']; ?></p>
    </div>
    <label class="about-sample">Автор</label>
    <div class="about-sample-text-block">
      <p class="theme"><?php echo $instruction_data['author']; ?></p>
    </div>
    <hr>
    <div class="com-text-container">
      <label>Комментарий к инструкции: </label></br>
      <p><?php echo $instruction_data['content']; ?></p>
    </div>
    <?php 
      if (!empty($instruction_data['files']['image'])) : 
        foreach ($instruction_data['files']['image'] as $key => $image) :
    ?>
      <hr>
      <div class="photo-block" id="<?php echo $key ; ?>">
        <img class="photo-block" src="/app/assets/documents/<?php echo $image ; ?>">
      </div>
    <?php 
      endforeach;
      endif; 
    ?>
    <?php 
      if (!empty($instruction_data['files']['video'])) : 
        foreach ($instruction_data['files']['video'] as $key => $video) :
    ?>
      <hr>
      <div class="video-block" id="<?php echo $key ; ?>">
        <video controls>
          <source class="video"  src="/app/assets/documents/<?php echo $video ; ?>">
        </video>
      </div>
    <?php 
      endforeach;
      endif; 
    ?>
    <?php 
      if (!empty($instruction_data['files']['application'])) : 
        foreach ($instruction_data['files']['application'] as $key => $doc) :
    ?>
      <hr>
      <div class="doc" id="<?php echo $key ; ?>">
        <p><a target="_blank" href="/app/assets/documents/<?php echo $doc ; ?>">Открыть инструкцию № <?php echo $key ; ?></a></p>
      </div>
    <?php 
      endforeach;
      endif; 
    ?>
  </fieldset>
  </div>
  </div>
</div>