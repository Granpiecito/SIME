/*CREATION sime_dev_db*/
/* Created 08/08/24 */
/* Last modify 23/08/24 */
/*Version 0.6*/

/*CREATE DATABASE sime_dev_db;*/
/*use sime_dev_db;*/

/* Table for system users registration */
create table cache (
    `key` varchar(255) not null primary key,
    value mediumtext not null,
    expiration int not null
) collate = utf8mb4_unicode_ci;

create table cache_locks (
    `key` varchar(255) not null primary key,
    owner varchar(255) not null,
    expiration int not null
) collate = utf8mb4_unicode_ci;

create table cat_coordinates (
    coordinates_id int auto_increment primary key,
    coordinates_xy point not null
) collate = utf8mb4_unicode_ci;

create spatial index coordinates_xy on cat_coordinates (coordinates_xy);

create table cat_cuaen_section (
    cuaen_section_id int auto_increment primary key,
    cuaen_section_description varchar(120) not null
) collate = utf8mb4_unicode_ci;

create table cat_cuaen_division (
    cuaen_division_id int auto_increment primary key,
    cuaen_section_id int null,
    cuaen_division_description varchar(120) not null,
    constraint cat_cuaen_division_ibfk_1 foreign key (cuaen_section_id) references cat_cuaen_section (cuaen_section_id)
) collate = utf8mb4_unicode_ci;

create index cuaen_section_id on cat_cuaen_division (cuaen_section_id);

create table cat_cuaen_group (
    cuaen_group_id int auto_increment primary key,
    cuaen_division_id int null,
    cuaen_group_description varchar(120) not null,
    constraint cat_cuaen_group_ibfk_1 foreign key (cuaen_division_id) references cat_cuaen_division (cuaen_division_id)
) collate = utf8mb4_unicode_ci;

create table cat_cuaen_class (
    cuaen_class_id int auto_increment primary key,
    cuaen_group_id int null,
    cuaen_class_description varchar(120) not null,
    constraint cat_cuaen_class_ibfk_1 foreign key (cuaen_group_id) references cat_cuaen_group (cuaen_group_id)
) collate = utf8mb4_unicode_ci;

create index cuaen_group_id on cat_cuaen_class (cuaen_group_id);

create index cuaen_division_id on cat_cuaen_group (cuaen_division_id);

create table cat_cuaen_subclass (
    cuaen_subclass_id int auto_increment primary key,
    cuaen_class_id int null,
    cuaen_subclass_description varchar(120) not null,
    constraint cat_cuaen_subclass_ibfk_1 foreign key (cuaen_class_id) references cat_cuaen_class (cuaen_class_id)
) collate = utf8mb4_unicode_ci;

create table cat_cuaen_dt (
    cat_cuaen_id int auto_increment primary key,
    cuaen_section_id int null,
    cuaen_division_id int null,
    cuaen_group_id int null,
    cuaen_class_id int null,
    cuaen_subclass_id int null,
    constraint cat_cuaen_dt_ibfk_1 foreign key (cuaen_section_id) references cat_cuaen_section (cuaen_section_id),
    constraint cat_cuaen_dt_ibfk_2 foreign key (cuaen_division_id) references cat_cuaen_division (cuaen_division_id),
    constraint cat_cuaen_dt_ibfk_3 foreign key (cuaen_group_id) references cat_cuaen_group (cuaen_group_id),
    constraint cat_cuaen_dt_ibfk_4 foreign key (cuaen_class_id) references cat_cuaen_class (cuaen_class_id),
    constraint cat_cuaen_dt_ibfk_5 foreign key (cuaen_subclass_id) references cat_cuaen_subclass (cuaen_subclass_id)
) collate = utf8mb4_unicode_ci;

create index cuaen_class_id on cat_cuaen_dt (cuaen_class_id);

create index cuaen_division_id on cat_cuaen_dt (cuaen_division_id);

create index cuaen_group_id on cat_cuaen_dt (cuaen_group_id);

create index cuaen_section_id on cat_cuaen_dt (cuaen_section_id);

create index cuaen_subclass_id on cat_cuaen_dt (cuaen_subclass_id);

create index cuaen_class_id on cat_cuaen_subclass (cuaen_class_id);

create table cat_cuonic_centralgroup (
    centralgroup_id int auto_increment primary key,
    centralgroup_description varchar(50) null
) collate = utf8mb4_unicode_ci;

create table cat_cuonic_principalgroup (
    principalgroup_id int auto_increment primary key,
    centralgroup_id int null,
    principalgroup_description varchar(50) null,
    constraint cat_cuonic_principalgroup_ibfk_1 foreign key (centralgroup_id) references cat_cuonic_centralgroup (centralgroup_id)
) collate = utf8mb4_unicode_ci;

create table cat_cuonic_group (
    group_id int auto_increment primary key,
    principalgroup_id int null,
    group_description varchar(50) null,
    constraint cat_cuonic_group_ibfk_1 foreign key (principalgroup_id) references cat_cuonic_principalgroup (principalgroup_id)
) collate = utf8mb4_unicode_ci;

create index principalgroup_id on cat_cuonic_group (principalgroup_id);

create table cat_cuonic_primarygroup (
    primarygroup_id int auto_increment primary key,
    group_id int null,
    primarygroup_description varchar(50) null,
    constraint cat_cuonic_primarygroup_ibfk_1 foreign key (group_id) references cat_cuonic_group (group_id)
) collate = utf8mb4_unicode_ci;

create index group_id on cat_cuonic_primarygroup (group_id);

create index centralgroup_id on cat_cuonic_principalgroup (centralgroup_id);

create table cat_cuonic_subgroup (
    subgroup_id int auto_increment primary key,
    primarygroup_id int null,
    subgroup_description varchar(50) null,
    constraint cat_cuonic_subgroup_ibfk_1 foreign key (primarygroup_id) references cat_cuonic_primarygroup (primarygroup_id)
) collate = utf8mb4_unicode_ci;

create table cat_cuonic_dt (
    cat_cuonic_id int auto_increment primary key,
    centralgroup_id int null,
    principalgroup_id int null,
    primarygroup_id int null,
    subgroup_id int null,
    constraint cat_cuonic_dt_ibfk_1 foreign key (centralgroup_id) references cat_cuonic_centralgroup (centralgroup_id),
    constraint cat_cuonic_dt_ibfk_2 foreign key (principalgroup_id) references cat_cuonic_principalgroup (principalgroup_id),
    constraint cat_cuonic_dt_ibfk_3 foreign key (primarygroup_id) references cat_cuonic_primarygroup (primarygroup_id),
    constraint cat_cuonic_dt_ibfk_4 foreign key (subgroup_id) references cat_cuonic_subgroup (subgroup_id)
) collate = utf8mb4_unicode_ci;

create index centralgroup_id on cat_cuonic_dt (centralgroup_id);

create index primarygroup_id on cat_cuonic_dt (primarygroup_id);

create index principalgroup_id on cat_cuonic_dt (principalgroup_id);

create index subgroup_id on cat_cuonic_dt (subgroup_id);

create index primarygroup_id on cat_cuonic_subgroup (primarygroup_id);

create table cat_department (
    department_id int auto_increment primary key,
    coordinates_id int null,
    department_name varchar(50) not null,
    constraint cat_department_ibfk_1 foreign key (coordinates_id) references cat_coordinates (coordinates_id)
) collate = utf8mb4_unicode_ci;

create index coordinates_id on cat_department (coordinates_id);

create table cat_directions_users (
    directions_id int auto_increment primary key,
    directions_name varchar(120) not null,
    directions_description varchar(120) null,
    directions_date timestamp default current_timestamp() not null on update current_timestamp()
) collate = utf8mb4_unicode_ci;

create table cat_municipality (
    municipality_id int auto_increment primary key,
    department_id int null,
    municipality_name varchar(50) not null,
    constraint cat_municipality_ibfk_1 foreign key (department_id) references cat_department (department_id)
) collate = utf8mb4_unicode_ci;

create table cat_comarca (
    comarca_id int auto_increment primary key,
    municipality_id int null,
    comarca_name varchar(50) not null,
    constraint cat_comarca_ibfk_1 foreign key (municipality_id) references cat_municipality (municipality_id)
) collate = utf8mb4_unicode_ci;

create index municipality_id on cat_comarca (municipality_id);

create index department_id on cat_municipality (department_id);

create table cat_neigborhood (
    neighborhood_id int auto_increment primary key,
    comarca_id int null,
    neigborhood_name varchar(50) not null,
    constraint cat_neigborhood_ibfk_1 foreign key (comarca_id) references cat_comarca (comarca_id)
) collate = utf8mb4_unicode_ci;

create index comarca_id on cat_neigborhood (comarca_id);

create table cat_organization (
    cat_organization_id int auto_increment primary key,
    cat_organization_type varchar(50) null
) collate = utf8mb4_unicode_ci;

create table cat_protagonist_territory (
    prota_territory_id int auto_increment primary key,
    department_id int null,
    prota_territory_name varchar(50) not null,
    constraint cat_protagonist_territory_ibfk_1 foreign key (department_id) references cat_department (department_id)
) collate = utf8mb4_unicode_ci;

create index department_id on cat_protagonist_territory (department_id);

create table dbo_module_sys (
    module_id int auto_increment primary key,
    module_name varchar(80) not null,
    module_description varchar(120) null,
    module_record_date datetime default current_timestamp() null,
    module_icon text not null,
    module_state int null
) collate = utf8mb4_unicode_ci;

create table dbo_permission_sys (
    permission_id int auto_increment primary key,
    permission_name varchar(80) not null,
    permission_description varchar(100) null
) collate = utf8mb4_unicode_ci;

create table dbo_permission_module (
    permissionmod_id int auto_increment primary key,
    permissionmod_module_id int null,
    permissionmod_permission_id int null,
    constraint dbo_permission_module_ibfk_1 foreign key (permissionmod_module_id) references dbo_module_sys (module_id),
    constraint dbo_permission_module_ibfk_2 foreign key (permissionmod_permission_id) references dbo_permission_sys (permission_id)
) collate = utf8mb4_unicode_ci;

create index permissionmod_module_id on dbo_permission_module (permissionmod_module_id);

create index permissionmod_permission_id on dbo_permission_module (permissionmod_permission_id);

create table dbo_person_sys (
    person_id int auto_increment primary key,
    directions_id int null,
    person_name varchar(120) not null,
    person_email varchar(100) not null,
    person_registration_date timestamp default current_timestamp() not null on update current_timestamp(),
    person_photo varchar(250) null,
    constraint person_email unique (person_email),
    constraint dbo_person_sys_ibfk_1 foreign key (directions_id) references cat_directions_users (directions_id)
) collate = utf8mb4_unicode_ci;

create index directions_id on dbo_person_sys (directions_id);

create table dbo_primary_production (
    pp_id int auto_increment primary key,
    pp_productive_cicle varchar(50) null,
    pp_amount_cultive_land varchar(50) null,
    pp_total_production decimal(10, 2) not null,
    pp_familiar_porcent float not null,
    pp_acces_market tinyint(1) null,
    pp_sale_porcent decimal(10, 2) not null,
    pp_exportation tinyint(1) null
) collate = utf8mb4_unicode_ci;

create table dbo_rol_sys (
    rol_id int auto_increment primary key,
    rol_name varchar(80) not null,
    rol_description varchar(250) null,
    rol_status int null
) collate = utf8mb4_unicode_ci;

create table dbo_secondary_production (
    sp_id int auto_increment primary key,
    sp_transform_value tinyint(1) null,
    sp_emp_name varchar(120) not null,
    sp_products_tv int null,
    sp_products_volume int null,
    sp_familiar_porcent float null,
    sp_acces_market tinyint(1) null,
    sp_sale_porcent_monthly float null,
    sp_organization tinyint(1) null,
    sp_exportation tinyint(1) null,
    constraint dbo_secondary_production_ibfk_1 foreign key (sp_products_tv) references cat_cuaen_dt (cat_cuaen_id),
    constraint dbo_secondary_production_ibfk_2 foreign key (sp_products_volume) references cat_cuaen_dt (cat_cuaen_id)
) collate = utf8mb4_unicode_ci;

create index sp_products_tv on dbo_secondary_production (sp_products_tv);

create index sp_products_volume on dbo_secondary_production (sp_products_volume);

create table dbo_submodule_sys (
    submodule_id int auto_increment primary key,
    module_id int null,
    submodule_name varchar(80) null,
    submodule_description varchar(120) null,
    submodule_links varchar(250) null,
    submodule_state int null,
    constraint dbo_submodule_sys_ibfk_1 foreign key (module_id) references dbo_module_sys (module_id)
) collate = utf8mb4_unicode_ci;

create index module_id on dbo_submodule_sys (module_id);

create table dbo_tertiary_production (
    tp_id int auto_increment primary key,
    tp_local_bussines_name varchar(120) not null,
    tp_comercial_product int null,
    tp_production_total_q int null,
    tp_sale_porcent_monthly float null,
    tp_organization tinyint(1) null,
    tp_exportation tinyint(1) null,
    constraint dbo_tertiary_production_ibfk_1 foreign key (tp_comercial_product) references cat_cuaen_dt (cat_cuaen_id)
) collate = utf8mb4_unicode_ci;

create index tp_comercial_product on dbo_tertiary_production (tp_comercial_product);

create table dbo_user_sys (
    user_id int auto_increment primary key,
    user_person_id int null,
    user_rol_id int null,
    user_name varchar(40) not null,
    user_record_date date not null,
    user_status int null,
    constraint user_name unique (user_name),
    constraint dbo_user_sys_ibfk_1 foreign key (user_person_id) references dbo_person_sys (person_id),
    constraint dbo_user_sys_ibfk_2 foreign key (user_rol_id) references dbo_rol_sys (rol_id)
) collate = utf8mb4_unicode_ci;

create table dbo_conecction_sys (
    conecction_id int auto_increment primary key,
    user_id int null,
    sessions_id varchar(255) null,
    conecction_ip varchar(250) not null,
    conecction_date_entry datetime default current_timestamp() null,
    conecction_state int null,
    logout_date varchar(60) null,
    constraint dbo_conecction_sys_ibfk_1 foreign key (user_id) references dbo_user_sys (user_id)
) collate = utf8mb4_unicode_ci;

create index user_id on dbo_conecction_sys (user_id);

create table dbo_protagonist (
    protagonist_id int auto_increment primary key,
    protagonist_name varchar(120) not null,
    protagonist_direction varchar(250) not null,
    protagonist_geographiczone varchar(12) not null,
    protagonist_gender varchar(7) not null,
    protagonist_academiclevel varchar(20) null,
    protagonist_disabled_state int null,
    protagonist_number int(8) not null,
    protagonist_email varchar(120) null,
    protagonist_climaticvulnb varchar(12) null,
    user_registration_id int null,
    protagonist_registration_date date not null,
    constraint protagonist_email unique (protagonist_email),
    constraint protagonist_number unique (protagonist_number),
    constraint dbo_protagonist_ibfk_1 foreign key (user_registration_id) references dbo_user_sys (user_id)
) collate = utf8mb4_unicode_ci;

create table cat_etnias_prota (
    etnias_prota_id int auto_increment primary key,
    protagonist_id int null,
    etnias_prota_name varchar(120) null,
    constraint cat_etnias_prota_ibfk_1 foreign key (protagonist_id) references dbo_protagonist (protagonist_id)
) collate = utf8mb4_unicode_ci;

create index protagonist_id on cat_etnias_prota (protagonist_id);

create table cat_protagonist_disbled (
    cat_disablep_id int auto_increment primary key,
    protagonist_id int null,
    cat_disablep_name varchar(120) null,
    constraint cat_protagonist_disbled_ibfk_1 foreign key (protagonist_id) references dbo_protagonist (protagonist_id)
) collate = utf8mb4_unicode_ci;

create index protagonist_id on cat_protagonist_disbled (protagonist_id);

create table dbo_counic_dt (
    counic_id int auto_increment primary key,
    cat_cuonic_id int null,
    protagonist_id int null,
    constraint dbo_counic_dt_ibfk_1 foreign key (cat_cuonic_id) references cat_cuonic_dt (cat_cuonic_id),
    constraint dbo_counic_dt_ibfk_2 foreign key (protagonist_id) references dbo_protagonist (protagonist_id)
) collate = utf8mb4_unicode_ci;

create index cat_cuonic_id on dbo_counic_dt (cat_cuonic_id);

create index protagonist_id on dbo_counic_dt (protagonist_id);

create table dbo_cuaen_dt (
    cuaen_dt_id int auto_increment primary key,
    cat_cuaen_id int null,
    production_type_id int not null,
    cat_organization_id int null,
    protagonist_id int null,
    constraint dbo_cuaen_dt_ibfk_1 foreign key (cat_cuaen_id) references cat_cuaen_dt (cat_cuaen_id),
    constraint dbo_cuaen_dt_ibfk_2 foreign key (cat_organization_id) references cat_organization (cat_organization_id),
    constraint dbo_cuaen_dt_ibfk_3 foreign key (protagonist_id) references dbo_protagonist (protagonist_id)
) collate = utf8mb4_unicode_ci;

create index cat_cuaen_id on dbo_cuaen_dt (cat_cuaen_id);

create index cat_organization_id on dbo_cuaen_dt (cat_organization_id);

create index protagonist_id on dbo_cuaen_dt (protagonist_id);

create index user_registration_id on dbo_protagonist (user_registration_id);

create table dbo_protagonist_xy (
    protagonistxy_id int auto_increment primary key,
    protagonsit_id int null,
    coordinates_id int null,
    constraint dbo_protagonist_xy_ibfk_1 foreign key (protagonsit_id) references dbo_protagonist (protagonist_id),
    constraint dbo_protagonist_xy_ibfk_2 foreign key (coordinates_id) references cat_coordinates (coordinates_id)
) collate = utf8mb4_unicode_ci;

create index coordinates_id on dbo_protagonist_xy (coordinates_id);

create index protagonsit_id on dbo_protagonist_xy (protagonsit_id);

create table dbo_user_details (
    user_details_id int auto_increment primary key,
    user_id int null,
    user_details_currentpassword varchar(60) not null,
    user_details_oldpassword varchar(60) null,
    constraint dbo_user_details_ibfk_1 foreign key (user_id) references dbo_user_sys (user_id)
) collate = utf8mb4_unicode_ci;

create index user_id on dbo_user_details (user_id);

create table dbo_user_permission_privilige (
    userprv_id int auto_increment primary key,
    module_id int null,
    permission_id int null,
    rol_id int null,
    authorization_priv int null,
    constraint dbo_user_permission_privilige_ibfk_1 foreign key (module_id) references dbo_module_sys (module_id),
    constraint dbo_user_permission_privilige_ibfk_2 foreign key (permission_id) references dbo_permission_module (permissionmod_id),
    constraint dbo_user_permission_privilige_ibfk_3 foreign key (rol_id) references dbo_rol_sys (rol_id),
    constraint dbo_user_permission_privilige_ibfk_4 foreign key (authorization_priv) references dbo_user_sys (user_id)
) collate = utf8mb4_unicode_ci;

create index authorization_priv on dbo_user_permission_privilige (authorization_priv);

create index module_id on dbo_user_permission_privilige (module_id);

create index permission_id on dbo_user_permission_privilige (permission_id);

create index rol_id on dbo_user_permission_privilige (rol_id);

create table dbo_user_privilege (
    userpriv_id int auto_increment primary key,
    submodule_id int null,
    module_id int null,
    rol_id int null,
    authrization_priv int null,
    constraint dbo_user_privilege_ibfk_1 foreign key (submodule_id) references dbo_submodule_sys (submodule_id),
    constraint dbo_user_privilege_ibfk_2 foreign key (module_id) references dbo_module_sys (module_id),
    constraint dbo_user_privilege_ibfk_3 foreign key (rol_id) references dbo_rol_sys (rol_id),
    constraint dbo_user_privilege_ibfk_4 foreign key (authrization_priv) references dbo_user_sys (user_id)
) collate = utf8mb4_unicode_ci;

create index authrization_priv on dbo_user_privilege (authrization_priv);

create index module_id on dbo_user_privilege (module_id);

create index rol_id on dbo_user_privilege (rol_id);

create index submodule_id on dbo_user_privilege (submodule_id);

create index user_person_id on dbo_user_sys (user_person_id);

create index user_rol_id on dbo_user_sys (user_rol_id);

create table failed_jobs (
    id bigint unsigned auto_increment primary key,
    uuid varchar(255) not null,
    connection text not null,
    queue text not null,
    payload longtext not null,
    exception longtext not null,
    failed_at timestamp default current_timestamp() not null,
    constraint failed_jobs_uuid_unique unique (uuid)
) collate = utf8mb4_unicode_ci;

create table job_batches (
    id varchar(255) not null primary key,
    name varchar(255) not null,
    total_jobs int not null,
    pending_jobs int not null,
    failed_jobs int not null,
    failed_job_ids longtext not null,
    options mediumtext null,
    cancelled_at int null,
    created_at int not null,
    finished_at int null
) collate = utf8mb4_unicode_ci;

create table jobs (
    id bigint unsigned auto_increment primary key,
    queue varchar(255) not null,
    payload longtext not null,
    attempts tinyint unsigned not null,
    reserved_at int unsigned null,
    available_at int unsigned not null,
    created_at int unsigned not null
) collate = utf8mb4_unicode_ci;

create index jobs_queue_index on jobs (queue);

create table migrations (
    id int unsigned auto_increment primary key,
    migration varchar(255) not null,
    batch int not null
) collate = utf8mb4_unicode_ci;

create table password_reset_tokens (
    email varchar(255) not null primary key,
    token varchar(255) not null,
    created_at timestamp null
) collate = utf8mb4_unicode_ci;

create table sessions (
    id varchar(255) not null primary key,
    user_id int null,
    ip_address varchar(45) null,
    user_agent text null,
    payload longtext not null,
    last_activity int not null
) collate = utf8mb4_unicode_ci;

create index sessions_last_activity_index on sessions (last_activity);

create index sessions_user_id_index on sessions (user_id);

create table tbl_juridic_protagonist (
    juridic_protagonist_id int auto_increment primary key,
    protagonist_id int null,
    juridic_prota_name varchar(120) not null,
    juridic_protagonist_ruc varchar(25) not null,
    constraint tbl_juridic_protagonist_ibfk_1 foreign key (protagonist_id) references dbo_protagonist (protagonist_id)
) collate = utf8mb4_unicode_ci;

create index protagonist_id on tbl_juridic_protagonist (protagonist_id);

create table tbl_natural_protagonist (
    natural_protagonist_id int auto_increment primary key,
    protagonist_id int null,
    natural_prota_lastname varchar(150) not null,
    natural_prota_identification varchar(17) not null,
    constraint natural_prota_identification unique (natural_prota_identification),
    constraint tbl_natural_protagonist_ibfk_1 foreign key (protagonist_id) references dbo_protagonist (protagonist_id)
) collate = utf8mb4_unicode_ci;

create index protagonist_id on tbl_natural_protagonist (protagonist_id);