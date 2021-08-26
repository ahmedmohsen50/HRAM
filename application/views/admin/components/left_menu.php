<?php
$session = $this->session->userdata('username');
$theme = $this->Xin_model->read_theme_info(1);
// set layout / fixed or static
if($theme[0]->right_side_icons=='true') {
	$icons_right = 'expanded menu-icon-right';
} else {
	$icons_right = '';
}
if($theme[0]->bordered_menu=='true') {
	$menu_bordered = 'menu-bordered';
} else {
	$menu_bordered = '';
}
$user_info = $this->Xin_model->read_user_info($session['user_id']);
if($user_info[0]->is_active!=1) {
	redirect('admin/');
}
$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);
if(!is_null($role_user)){
	$role_resources_ids = explode(',',$role_user[0]->role_resources);
} else {
	$role_resources_ids = explode(',',0);	
}
?>
<?php $system = $this->Xin_model->read_setting_info(1);?>
<?php $arr_mod = $this->Xin_model->select_module_class($this->router->fetch_class(),$this->router->fetch_method()); ?>
<?php 
if($theme[0]->sub_menu_icons != ''){
	$submenuicon = $theme[0]->sub_menu_icons;
} else {
	$submenuicon = 'fa-circle-o';
}
// reports to 
  $reports_to = get_reports_team_data($session['user_id']);
?>
<?php  if($user_info[0]->profile_picture!='' && $user_info[0]->profile_picture!='no file') {?>
<?php $cpimg = base_url().'uploads/profile/'.$user_info[0]->profile_picture;?>
<?php } else {?>
<?php  if($user_info[0]->gender=='Male') { ?>
<?php 	$de_file = base_url().'uploads/profile/default_male.jpg';?>
<?php } else { ?>
<?php 	$de_file = base_url().'uploads/profile/default_female.jpg';?>
<?php } ?>
<?php $cpimg = $de_file;?>
<?php  } ?>

<ul class="sidenav-inner py-1">
  <!-- Dashboards -->
  <li class="sidenav-item <?php if(!empty($arr_mod['active']))echo $arr_mod['active'];?>"> <a href="<?php echo site_url('admin/dashboard');?>" class="sidenav-link"> <i class="sidenav-icon ion ion-md-speedometer"></i>
    <div><?php echo $this->lang->line('dashboard_title');?></div>
    </a> </li>
  <?php if(in_array('13',$role_resources_ids) || in_array('7',$role_resources_ids) || in_array('422',$role_resources_ids) || $reports_to>0 || $user_info[0]->user_role_id==1){?>
  <li class="<?php if(!empty($arr_mod['stff_open']))echo $arr_mod['stff_open'];?> sidenav-item"> <a href="#" class="sidenav-link sidenav-toggle"> <i class="sidenav-icon fas fa-user-friends"></i>
    <div><?php echo $this->lang->line('dashboard_employees');?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if($user_info[0]->user_role_id==1){?>
      <?php if(in_array('422',$role_resources_ids)) { ?>
      <?php } ?>
      <?php } ?>
      <?php if(in_array('13',$role_resources_ids) || $reports_to>0) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['hremp_active']))echo $arr_mod['hremp_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/employees/');?>" > <?php echo $this->lang->line('dashboard_employees');?> </a> </li>
      <?php } ?>
      <?php if($user_info[0]->user_role_id==1){?>

      <?php } ?>
      <?php if(in_array('7',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['shift_active']))echo $arr_mod['shift_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/timesheet/office_shift/');?>"> <?php echo $this->lang->line('left_office_shifts');?> </a> </li>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php if($system[0]->module_payroll=='yes'){?>
  <?php if(in_array('36',$role_resources_ids) && in_array('37',$role_resources_ids)){?>
  <li class="sidenav-item <?php if(!empty($arr_mod['pay_generate_active']))echo $arr_mod['pay_generate_active'];?>"> <a href="<?php echo site_url('admin/payroll/generate_payslip/');?>" class="sidenav-link"> <i class="sidenav-icon fa fa-calculator"></i>
    <div><?php echo $this->lang->line('left_payroll');?></div>
    </a> </li>
  <?php } ?>
  <?php if(in_array('36',$role_resources_ids) && !in_array('37',$role_resources_ids)){?>
  <li class="sidenav-item <?php if(!empty($arr_mod['pay_generate_active']))echo $arr_mod['pay_generate_active'];?>"> <a href="<?php echo site_url('admin/payroll/generate_payslip/');?>" class="sidenav-link"> <i class="sidenav-icon fa fa-calculator"></i>
    <div><?php echo $this->lang->line('left_payroll');?></div>
    </a> </li>
  <?php } ?>
  <?php } ?>
  <?php if($system[0]->module_accounting=='true'){?>
  <?php if(in_array('286',$role_resources_ids) || in_array('72',$role_resources_ids) || in_array('75',$role_resources_ids) || in_array('76',$role_resources_ids) || in_array('77',$role_resources_ids) || in_array('78',$role_resources_ids)){?>
  
  <?php } ?>
  <?php } ?>
  <?php  if(in_array('12',$role_resources_ids) || in_array('14',$role_resources_ids) || in_array('15',$role_resources_ids) || in_array('16',$role_resources_ids) || in_array('17',$role_resources_ids) || in_array('18',$role_resources_ids) || in_array('19',$role_resources_ids) || in_array('20',$role_resources_ids) || in_array('21',$role_resources_ids) || in_array('22',$role_resources_ids) || in_array('23',$role_resources_ids)){?>
  <li class="<?php if(!empty($arr_mod['emp_open']))echo $arr_mod['emp_open'];?> sidenav-item"> <a href="#" class="sidenav-link sidenav-toggle"> <i class="sidenav-icon ion ion-ios-globe"></i>
    <div><?php echo $this->lang->line('xin_hr');?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if($system[0]->module_awards=='true'){?>
      <?php if(in_array('14',$role_resources_ids)) { ?>
      <?php } ?>
      <?php } ?>
      <?php if(in_array('15',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['tra_active']))echo $arr_mod['tra_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/transfers');?>" > <?php echo $this->lang->line('left_transfers');?> </a> </li>
      <?php } ?>
      <?php if(in_array('16',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['res_active']))echo $arr_mod['res_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/resignation');?>" > <?php echo $this->lang->line('left_resignations');?> </a> </li>
      <?php } ?>
      <?php if($system[0]->module_travel=='true'){?>
      <?php if(in_array('17',$role_resources_ids)) { ?>
      <?php } ?>
      <?php } ?>
      <?php if(in_array('18',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('19',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('20',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['warn_active']))echo $arr_mod['warn_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/warning');?>"> <?php echo $this->lang->line('left_warnings');?> </a> </li>
      <?php } ?>
      <?php if(in_array('21',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['term_active']))echo $arr_mod['term_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/termination');?>"> <?php echo $this->lang->line('left_terminations');?> </a> </li>
      <?php } ?>
      <?php if(in_array('23',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('22',$role_resources_ids) || $reports_to > 0) { ?>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php if(in_array('2',$role_resources_ids) || in_array('3',$role_resources_ids) || in_array('4',$role_resources_ids) || in_array('5',$role_resources_ids) || in_array('6',$role_resources_ids) || in_array('11',$role_resources_ids) || in_array('9',$role_resources_ids)){?>
  <li class="<?php if(!empty($arr_mod['adm_open']))echo $arr_mod['adm_open'];?> sidenav-item"> <a href="#" class="sidenav-link sidenav-toggle"> <i class="sidenav-icon ion ion-md-business"></i>
    <div><?php echo $this->lang->line('left_organization');?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if(in_array('5',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('6',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('3',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['dep_active']))echo $arr_mod['dep_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/department/');?>" > <?php echo $this->lang->line('left_department');?> </a> </li>
      <?php } ?>
      <?php if(in_array('4',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['des_active']))echo $arr_mod['des_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/designation/');?>" > <?php echo $this->lang->line('left_designation');?> </a> </li>
      <?php } ?>
      <?php if(in_array('11',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('9',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['pol_active']))echo $arr_mod['pol_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/policy/');?>" > <?php echo $this->lang->line('header_policies');?> </a> </li>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php if(in_array('27',$role_resources_ids) || in_array('423',$role_resources_ids) || in_array('10',$role_resources_ids) || in_array('30',$role_resources_ids) || in_array('401',$role_resources_ids) || in_array('261',$role_resources_ids) || in_array('28',$role_resources_ids)){?>
  <li class="<?php if(!empty($arr_mod['attnd_open']))echo $arr_mod['attnd_open'];?> sidenav-item"> <a href="#" class="sidenav-link sidenav-toggle"> <i class="sidenav-icon ion ion-md-clock"></i>
    <div><?php echo $this->lang->line('left_timesheet');?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if(in_array('423',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('28',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['attnd_active']))echo $arr_mod['attnd_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/timesheet/attendance/');?>" > <?php echo $this->lang->line('left_attendance');?> </a> </li>
      <?php } ?>
      <?php if(in_array('30',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['upd_attnd_active']))echo $arr_mod['upd_attnd_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/timesheet/update_attendance/');?>" > <?php echo $this->lang->line('left_update_attendance');?> </a> </li>
      <?php } ?>
      <?php if(in_array('10',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('261',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['timecalendar_active']))echo $arr_mod['timecalendar_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/timesheet/timecalendar/');?>" > <?php echo $this->lang->line('xin_acc_calendar');?> </a> </li>
      <?php } ?>
      <?php if(in_array('401',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['overtime_request_act']))echo $arr_mod['overtime_request_act'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/overtime_request/');?>" > <?php echo $this->lang->line('xin_overtime_request');?> </a> </li>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php if(in_array('95',$role_resources_ids)) { ?>
  <li class="sidenav-item <?php if(!empty($arr_mod['calendar_hr_active']))echo $arr_mod['calendar_hr_active'];?>"> <a href="<?php echo site_url('admin/calendar/hr/');?>" class="sidenav-link"> <i class="sidenav-icon oi oi-calendar"></i>
    <div><?php echo $this->lang->line('xin_hr_calendar_title');?></div>
    </a> </li>
  <?php } ?>
  <?php if($system[0]->module_payroll=='yes'){?>
  <?php if(!in_array('36',$role_resources_ids) && in_array('37',$role_resources_ids)){?>
  <li class="sidenav-item <?php if(!empty($arr_mod['pay_generate_active']))echo $arr_mod['pay_generate_active'];?>"> <a href="<?php echo site_url('admin/payroll/payment_history/');?>" class="sidenav-link"> <i class="sidenav-icon fa fa-calculator"></i>
    <div><?php echo $this->lang->line('xin_payslip_history');?></div>
    </a> </li>
  <?php } ?>
  <?php } ?>
  <?php if(in_array('45',$role_resources_ids) || in_array('90',$role_resources_ids) || in_array('91',$role_resources_ids)){?>
  
  <?php } ?>
  <?php if(in_array('47',$role_resources_ids) || in_array('400',$role_resources_ids) || in_array('442',$role_resources_ids)){?>
  <li class="<?php if(!empty($arr_mod['files_open']))echo $arr_mod['files_open'];?> sidenav-item"> <a href="#" class="sidenav-link sidenav-toggle"> <i class="sidenav-icon fas fa-file-signature"></i>
    <div><?php echo $this->lang->line('xin_files');?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if(in_array('47',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['file_active']))echo $arr_mod['file_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/files/');?>" > <?php echo $this->lang->line('xin_files');?> </a> </li>
      <?php } ?>
      <?php if(in_array('442',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['official_documents_active']))echo $arr_mod['official_documents_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/company/official_documents/');?>" > <?php echo $this->lang->line('xin_hr_official_documents');?> </a> </li>
      <?php } ?>
      <?php if(in_array('400',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['expired_documents_active']))echo $arr_mod['expired_documents_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/employees/expired_documents/');?>" > <?php echo $this->lang->line('xin_e_details_exp_documents');?> </a> </li>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php if(in_array('121',$role_resources_ids) || in_array('330',$role_resources_ids) || in_array('122',$role_resources_ids) || in_array('426',$role_resources_ids)){?>
    <div><?php ?></div>
    </a>
   
  </li>
  <?php } ?>
  <?php if(in_array('46',$role_resources_ids) && in_array('409',$role_resources_ids)){?>
  <li class="sidenav-item <?php if(!empty($arr_mod['leave_active']))echo $arr_mod['leave_active'];?>"> <a href="<?php echo site_url('admin/timesheet/leave/');?>" class="sidenav-link"> <i class="sidenav-icon fas fa-calendar-alt"></i>
    <div><?php echo $this->lang->line('xin_manage_leaves');?></div>
    </a> </li>
  <?php } ?>
  <?php if(in_array('46',$role_resources_ids) && !in_array('409',$role_resources_ids)){?>
  <li class="sidenav-item <?php if(!empty($arr_mod['leave_active']))echo $arr_mod['leave_active'];?>"> <a href="<?php echo site_url('admin/timesheet/leave/');?>" class="sidenav-link"> <i class="sidenav-icon fas fa-calendar-alt"></i>
    <div><?php echo $this->lang->line('xin_manage_leaves');?></div>
    </a> </li>
  <?php } ?>
  <?php if(!in_array('46',$role_resources_ids) && in_array('409',$role_resources_ids)){?>
  <li class="sidenav-item <?php if(!empty($arr_mod['leave_active']))echo $arr_mod['leave_active'];?>"> <a href="<?php echo site_url('admin/reports/employee_leave/');?>" class="sidenav-link"> <i class="sidenav-icon fas fa-calendar-alt"></i>
    <div><?php echo $this->lang->line('xin_leave_status');?></div>
    </a> </li>
  <?php } ?>
  <?php if(in_array('44',$role_resources_ids) || in_array('312',$role_resources_ids) || in_array('119',$role_resources_ids) || in_array('94',$role_resources_ids) || in_array('424',$role_resources_ids) || in_array('425',$role_resources_ids)){?>
    <div><?php?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if(in_array('312',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['projects_dashboard_active']))echo $arr_mod['projects_dashboard_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/project/projects_dashboard/');?>" > <?php echo $this->lang->line('dashboard_title');?> </a> </li>
      <?php } ?>
      <?php if(in_array('44',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['project_active']))echo $arr_mod['project_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/project/');?>" > <?php echo $this->lang->line('left_projects');?> </a> </li>
      <?php } ?>
      <?php if(in_array('119',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['clients_active']))echo $arr_mod['clients_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/clients/');?>" > <?php echo $this->lang->line('xin_project_clients');?> </a> </li>
      <?php } ?>
      <?php if(in_array('94',$role_resources_ids)) { ?>
      <li class="sidenav-item <?php if(!empty($arr_mod['project_timelogs_active']))echo $arr_mod['project_timelogs_active'];?>"> <a class="sidenav-link" href="<?php echo site_url('admin/project/timelogs/');?>" > <?php echo $this->lang->line('xin_project_timelogs');?> </a> </li>
      <?php } ?>
      <?php if(in_array('424',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('425',$role_resources_ids)) { ?>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php if(in_array('415',$role_resources_ids) || in_array('410',$role_resources_ids) || in_array('427',$role_resources_ids) || in_array('428',$role_resources_ids) || in_array('429',$role_resources_ids) || in_array('430',$role_resources_ids)){?>
    <div><?php ?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if(in_array('415',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('427',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('429',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('430',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('428',$role_resources_ids)) { ?>
      <?php } ?>
    </ul>
  </li>
  <?php } //297?>
  <?php if($system[0]->module_recruitment=='true'){?>
  <?php  if(in_array('49',$role_resources_ids) || in_array('51',$role_resources_ids) || in_array('52',$role_resources_ids) || in_array('296',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_recruitment');?></div>
    </a>
    <ul class="sidenav-menu">
      <?php if(in_array('49',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('51',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('52',$role_resources_ids)) { ?>
      <?php } ?>
      <?php if(in_array('296',$role_resources_ids)) { ?>
      <?php } ?>
    </ul>
  </li>
  <?php } ?>
  <?php } ?>
  <?php if($system[0]->module_performance=='yes'){?>
  <?php if($system[0]->performance_option == 'goal'): ?>
  <?php if(in_array('106',$role_resources_ids) || in_array('107',$role_resources_ids) || in_array('108',$role_resources_ids)){?>
  <?php if(in_array('107',$role_resources_ids) && in_array('108',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_performance');?></div>
    </a> </li>
  <?php } ?>
  <?php if(in_array('107',$role_resources_ids) && !in_array('108',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_performance');?></div>
    </a> </li>
  <?php } ?>
  <?php if(!in_array('107',$role_resources_ids) && in_array('108',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('xin_hr_goal_tracking_type_se');?></div>
    </a> </li>
  <?php } ?>
  <?php } ?>
  <?php elseif($system[0]->performance_option == 'appraisal'): ?>
  <?php if(in_array('40',$role_resources_ids) || in_array('41',$role_resources_ids) || in_array('42',$role_resources_ids)) {?>
  <?php if(in_array('41',$role_resources_ids) && in_array('42',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_performance');?></div>
    </a> </li>
  <?php } ?>
  <?php if(!in_array('41',$role_resources_ids) && in_array('42',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_performance');?></div>
    </a> </li>
  <?php } ?>
  <?php if(in_array('41',$role_resources_ids) && !in_array('42',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_performance');?></div>
    </a> </li>
  <?php } ?>
  <?php } ?>
  <?php else:?>
  <?php if(in_array('40',$role_resources_ids) || in_array('41',$role_resources_ids) || in_array('42',$role_resources_ids)) {?>
  <?php if(in_array('41',$role_resources_ids) && in_array('42',$role_resources_ids)) {?>
    <div><?php ?></div>
    </a> </li>
  <?php } ?>
  <?php if(!in_array('41',$role_resources_ids) && in_array('42',$role_resources_ids)) {?>
    <div><?php ?></div>
    </a> </li>
  <?php } ?>
  <?php if(in_array('41',$role_resources_ids) && !in_array('42',$role_resources_ids)) {?>
    <div><?php echo $this->lang->line('left_performance');?></div>
    </a> </li>
  <?php } ?>
  <?php } ?>
  <?php endif;?>
  <?php } ?>
</ul>
