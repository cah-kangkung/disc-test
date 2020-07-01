<section>
    <div class="container">

        <h2 class="mb-5">Edit Profile</h2>

        <?php if ($this->session->flashdata('danger_alert')) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('danger_alert'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success_alert')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success_alert'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8">
                <?php echo form_open_multipart('profile'); ?>

                <h4>Profile Picture</h4>
                <hr>
                <div class="form-group row mb-5">
                    <div class="col-sm-3 mb-3">
                        <img src="<?php echo base_url() . 'assets/img/profile-pictures/' . $user_data['image']; ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-4 my-auto">
                        <button type="button" class="btn btn-primary">
                            <input type="file" name="image" id="image">
                        </button>
                    </div>
                </div>

                <h4>Information</h4>
                <hr>
                <div class="form-group row">
                    <label for="first_name" class="col-xl-2 col-form-label">First Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_data['first_name'] ?>">
                        <?php echo form_error('first_name', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-xl-2 col-form-label">Last Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_data['last_name'] ?>">
                        <?php echo form_error('last_name', '<small class="text-danger pl-2">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-xl-2 col-form-label">Email</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_data['email'] ?>" readonly>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-sm-3 mb-3">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                    <div class="col-sm-9">
                        <a href="<?php echo site_url(); ?>profile/change_password" class="btn btn-primary">
                            Change Password
                        </a>
                    </div>
                </div>

                </form>
            </div>
        </div>

    </div>
</section>