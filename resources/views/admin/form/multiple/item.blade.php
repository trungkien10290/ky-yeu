<?php if(!empty($item)): ?>
<?php
$info = explode('.', $item);
$extension = array_pop($info) ?? '';

$img = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'svg', 'gif']) ? $item : ('/admins/ico/' . $extension . '.jpg');
?>
<div class="item_multiple_preview">
    <i class="fa fa-trash delete"></i>
    <?php if(in_array(strtolower($extension), ['mp4'])): ?>
    <video src="{{$item}}" height="100" controls>
        <source src="{{$item}}" type="video/mp4">
    </video>
    <?php else: ?>
    <img src="{{image($img)}}" alt="" height="100">
    <?php endif ?>
    <input type="hidden" name="{{$name}}" value="{{$item}}">
</div>
<?php endif ?>
