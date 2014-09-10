<!-- File: /app/View/Posts/index.ctp -->

<h1>News Letter</h1>
<p><?php echo $this->Html->link('Add Newsletter', array('action' => 'add')); ?></p>
<p><?php echo $this->Html->link('Show Newsletters', array('action' => 'show')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>link</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $newsletters array, printing out newsletter info-->
    <?php foreach ($newsletters as $newsletter): ?>
    <tr>
        <td><?php echo $newsletter['Newsletter']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $newsletter['Newsletter']['title'],
                    array('action' => 'view', $newsletter['Newsletter']['id'])
                );
            ?>
        </td>
        <td>
            <?php $link=$newsletter['Newsletter']['link'];
                echo $this->Html->link(
                    $newsletter['Newsletter']['link'],'http://'.$link,
                    array('target'=>'_blank','escape' => false)
                );
            ?>            
        </td>
        <td>
            <?php
                echo $this->Html->link(
                    $newsletter['Newsletter']['created'],$newsletter['Newsletter']['created'],
                    array()
                );
            ?>            
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $newsletter['Newsletter']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $newsletter['Newsletter']['id'])
                );
            ?>
        </td>
     </tr>
    <?php endforeach; ?>

</table>