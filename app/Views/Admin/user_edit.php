<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>

<style>
    
   .btn {
     background-color: beige;
    color: black;
    font-family: var(--ff-oswald);
    font-size: var(--fs-6);
    font-weight: var(--fw-500);
    letter-spacing: 1px;
    text-transform: uppercase;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 13px 34px;
    clip-path: var(--polygon-1);
    transition: var(--transition-1);
   }
</style>
<div class="row justify-content-center">
   <!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+UPmUSVOJXQOqa1Je7GOmMaXZzZtoUAOaEvKFVpEEj0fzZt" crossorigin="anonymous">

<!-- Add Bootstrap JavaScript (and its dependencies, if required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-Dziyf5hFm7P2qzFQUvEoC4KCZnQApFmCwG5wALv/O9vYzwxIka7jU2yG5FfJ4p8k" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-AbhknbwMfOiN4Q5mi8L8aB1iuXl8Ct6F9l8bX8IcfxiFz7dV8BGSX8T3l02oJr7F" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-1ss8GKvlzGYJlLPJW8mNEu6/s9CaQ3XqSl1n9Xw5d9iiRH6I8U8Htvu1Zi4fC73F" crossorigin="anonymous"></script>

<style>
    
    .about-content {
    max-width: 1117px;
    margin-inline: 0;
    
    
}
  
   .btn {
     background-color: beige;
    color: black;
    font-family: var(--ff-oswald);
    font-size: var(--fs-6);
    font-weight: var(--fw-500);
    letter-spacing: 1px;
    text-transform: uppercase;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 13px 34px;
    clip-path: var(--polygon-1);
    transition: var(--transition-1);
   }
</style>
  
            
            
             <div class="section-wrapper">
 
        <!-- 
          - #ABOUT
        -->

        <section class="about" id="about">
         


            <div class="about-content">

              <p class="about-subtitle">Welcome </p>

              <h2 class="about-title">Manage <strong>Users </strong> </h2>
   Edit Account &middot; <?= getName($target) ?>
              <div class="card-body">
            <div class="card-body">
                <?= form_open() ?>
                <input type="hidden" name="user_id" value="<?= $target->id_users ?>">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="" aria-describedby="help-username" value="<?= old('username') ?: $target->username ?>">
                        <?php if ($validation->hasError('username')) : ?>
                            <small id="help-username" class="form-text text-danger"><?= $validation->getError('username') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="" aria-describedby="help-fullname" value="<?= old('fullname') ?: $target->fullname ?>">
                        <?php if ($validation->hasError('fullname')) : ?>
                            <small id="help-fullname" class="form-text text-danger"><?= $validation->getError('fullname') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="level" class="form-label">Roles</label>
                        <?php $sel_level = ['' => '&mdash; Select Roles &mdash;', '1' => 'Admin', '2' => 'Reseller',]; ?>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'level', 'id' => 'level'], $sel_level, $target->level) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="status" class="form-label">Status</label>
                        <?php $sel_status = ['' => '&mdash; Select Status &mdash;', '0' => 'Banned/Block', '1' => 'Active',]; ?>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'status', 'id' => 'status'], $sel_status, $target->status) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="saldo" class="form-label">Saldo</label>
                        <input type="number" name="saldo" id="saldo" class="form-control" placeholder="" aria-describedby="help-saldo" value="<?= old('saldo') ?: $target->saldo ?>">
                        <?php if ($validation->hasError('saldo')) : ?>
                            <small id="help-saldo" class="form-text text-danger"><?= $validation->getError('saldo') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="uplink" class="form-label">Uplink</label>
                        <input type="text" name="uplink" id="uplink" class="form-control" placeholder="" aria-describedby="help-uplink" value="<?= old('uplink') ?: $target->uplink ?>">
                        <?php if ($validation->hasError('uplink')) : ?>
                            <small id="help-uplink" class="form-text text-danger"><?= $validation->getError('uplink') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-outline-dark">Update Account Information</button>
                    </div>
                </div>
                <?= form_close() ?>
    </div>

 
            

          </div>
        </section>
       
</div>
        <p class="text-muted text-center">
            <a href="<?= site_url('admin/manage-users') ?>" class="py-1 px-2 bg-white text-muted"><small><i class="bi bi-arrow-left"></i> Back to Manage users</small></a>
        </p>
    </div>
</div>
<?= $this->endSection() ?>