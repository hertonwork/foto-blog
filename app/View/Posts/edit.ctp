<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post', array('url' => array('action' => 'edit'), 'enctype' => 'multipart/form-data'));
echo $this->Form->input('title');
echo $this->Form->input('upload', array('type' => 'file'));
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>