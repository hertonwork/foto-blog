<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('url' => array('action' => 'add'), 'enctype' => 'multipart/form-data'));
echo $this->Form->input('title');
echo $this->Form->input('upload', array('type' => 'file'));
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
?>