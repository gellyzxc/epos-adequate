INSERT INTO "school_classes" ("id", "school", "name", "number", "created_at", "updated_at") VALUES
('9ad95755-49c7-4e09-a66f-9b6281a83521',	'9ad943ab-85e6-49e8-97e7-c6fae159f5e3',	'МАТ1',	10,	'2023-12-14 19:37:17',	'2023-12-14 19:37:17'),
('9ad95797-42af-4d60-98df-6ecf4661ee33',	'9ad943ab-85e6-49e8-97e7-c6fae159f5e3',	'БИО',	10,	'2023-12-14 19:38:01',	'2023-12-14 19:38:01'),
('9adabd75-6124-4c43-a863-c2933ef4aa03',	'9ad943ab-85e6-49e8-97e7-c6fae159f5e3',	'ГЕО',	11,	'2023-12-15 12:18:41',	'2023-12-15 12:18:41');

INSERT INTO "schools" ("id", "name", "address", "mark_max", "data", "created_at", "updated_at") VALUES
('9ad943ab-85e6-49e8-97e7-c6fae159f5e3',	'Лицей 2',	'Самаркандская 102',	10,	'"{}"',	'2023-12-14 18:42:18',	'2023-12-14 18:42:18');

INSERT INTO "users" ("id", "first_name", "last_name", "middle_name", "email", "password", "role", "created_at", "updated_at") VALUES
('9ad93d31-834d-469b-8296-e8e3ec526eb6',	'Yuriy',	'Safin',	'Vadimovich',	'admin@mail.ru',	'$2y$12$gjRcv81pCl4xZ3wtJzv8MemQYZJgKsN0uqo77FMrmkD4O9BYc/..K',	'admin',	'2023-12-14 18:24:12',	'2023-12-14 18:24:12');

ALTER TABLE ONLY "public"."class_pupils" ADD CONSTRAINT "class_pupils_school_class_foreign" FOREIGN KEY (school_class) REFERENCES school_classes(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."class_pupils" ADD CONSTRAINT "class_pupils_user_foreign" FOREIGN KEY ("user") REFERENCES users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."marks" ADD CONSTRAINT "marks_user_foreign" FOREIGN KEY ("user") REFERENCES users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."parent_users" ADD CONSTRAINT "parent_users_child_foreign" FOREIGN KEY (child) REFERENCES users(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."parent_users" ADD CONSTRAINT "parent_users_parent_foreign" FOREIGN KEY (parent) REFERENCES users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."profile_teachers" ADD CONSTRAINT "profile_teachers_subject_foreign" FOREIGN KEY (subject) REFERENCES school_subjects(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."profile_teachers" ADD CONSTRAINT "profile_teachers_teacher_foreign" FOREIGN KEY (teacher) REFERENCES users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."pupil_users" ADD CONSTRAINT "pupil_users_school_class_foreign" FOREIGN KEY (school_class) REFERENCES school_classes(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."pupil_users" ADD CONSTRAINT "pupil_users_user_foreign" FOREIGN KEY ("user") REFERENCES users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."school_classes" ADD CONSTRAINT "school_classes_school_foreign" FOREIGN KEY (school) REFERENCES schools(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."school_subjects" ADD CONSTRAINT "school_subjects_school_foreign" FOREIGN KEY (school) REFERENCES schools(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."school_teachers" ADD CONSTRAINT "school_teachers_leader_foreign" FOREIGN KEY (leader) REFERENCES school_classes(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."school_teachers" ADD CONSTRAINT "school_teachers_teacher_foreign" FOREIGN KEY (teacher) REFERENCES users(id) NOT DEFERRABLE;
