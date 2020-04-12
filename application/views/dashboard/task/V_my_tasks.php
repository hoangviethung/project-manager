<div class="card__header">
    <div class="card__header-title">
        <h3>Tasks</h3>
    </div>
</div>
<div class="card__body">
    <!-- <div class="btn bth-create w-100 mb-2">Create new task</div> -->
    <div class="block-list-recent">
        <div class="title">Assigned to me</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if($taskAssignedToMe):?>
                <?php foreach($taskAssignedToMe as $task):?>
                    <div class="item">
                        <div class="text">
                        <div class="name"><?php echo $task->name .'(ID#: '.$task->id.')';?></div>
                            <div class="history">Changed Recently: <?php echo $task->last_update;?></div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                No Task Found
            <?php endif;?>
        </div>
    </div>
    <div class="block-list-recent">
        <div class="title">Monitor Task</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if($taskMonitoredByMe):?>
                <?php foreach($taskMonitoredByMe as $task):?>
                    <div class="item">
                        <div class="text">
                            <div class="name"><?php echo $task->name .'(ID#: '.$task->id.')';?></div>
                            <div class="history">Changed Recently: <?php echo $task->last_update;?></div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                No Task Found
            <?php endif;?>
        </div>
    </div>
    <div class="block-list-recent">
        <div class="title">Recently Modified Task</div>
        <div class="list-item">
            <!-- ĐIỀU ĐỦ CÁC THÔNG SỐ VÀO ICON PROJECT JS SẼ TỰ ĐỘNG SET CSS-->
            <?php if($recentTasks):?>
                <?php foreach($recentTasks as $recentTask):?>
                    <div class="item">
                        <div class="text">
                        <div class="name"><?php echo $recentTask->name .'(ID#: '.$recentTask->id.')';?></div>
                            <div class="history">Changed Recently: <?php echo $recentTask->last_update;?></div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                No recent tasks
            <?php endif;?>
        </div>
    </div>
</div>