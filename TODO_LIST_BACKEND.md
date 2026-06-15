# TODO LIST — Backend & Dashboard (Online Labo Booking System)

> **Maelezo:** Hii ni orodha ya maelekezo pekee. Usibadilishe mfumo bila kufuata hatua hizi kwa mpangilio.
> **Lugha ya Backend:** PHP  
> **Database:** `online_labo` (tayari ipo — `online_labo.sql`)  
> **Kanuni:** DRY (Don't Repeat Yourself)

---

## MUHTASARI WA HALI YA SASA

| Sehemu | Hali | Maelezo |
|--------|------|---------|
| Database connection | ✅ Tayari | `config/db.php` — mysqli, utf8mb4 |
| Register | ✅ Inafanya kazi | `auth/register_process.php` — transaction, prepared statements, role tables |
| Login | ⚠️ Nusu | Inaingiza session, lakini hakikishi `status`, hakijaza data zote za session |
| Auth middleware | ✅ Tayari | `auth/auth.php` — login + role check |
| Dashboard routing | ✅ Tayari | `admin/doctor/patient/labo/dashboard.php` — pattern sawa (DRY) |
| Layout & sidebars | ✅ Tayari | `shared/layout.php` + `sidebars/{role}.php` |
| Dashboard content (data halisi) | ❌ Haijaunganishwa | Takwimu zote ni static/demo HTML |
| Process/action files kwa dashboards | ❌ Hayapo | Hakuna `*_process.php` kwa appointments, users, n.k. |
| Models/Repositories | ❌ Hayapo | SQL iko tu kwenye auth; dashboards hazina DB queries |

---

## KILICHO TAYARI — HAKINA SHIDA KUBWA (Usiguse isipokuwa kwa sababu maalum)

### 1. Muundo wa folda
```
auth/          → login, register, logout, auth middleware
config/        → db.php
admin/         → dashboard + content/
doctor/        → dashboard + content/
patient/       → dashboard + content/
labo/          → dashboard + content/
shared/        → layout, head, topnav
sidebars/      → menyu kwa kila role
```

### 2. Database schema (msingi mzuri)
- Jedwali kuu: `users` (roles: admin, doctor, patient, labo)
- Jedwali za role: `patients`, `doctors`, `laboratories`
- Uhusiano: `appointments`, `appointment_tests`, `test_results`, `payments`, n.k.
- Foreign keys zimewekwa vizuri
- Data ya majaribio ipo (users 19–25, doctors, patients, laboratories)

### 3. Register flow
- Inaingiza `users` + jedwali la role kwa transaction
- Picha ya profile inahifadhiwa `assets/uploads/`
- Password ina-hash kwa `password_hash()`

### 4. Dashboard controller (DRY)
Kila dashboard inatumia pattern hii — **endelea kutumia hii, usiandike upya:**
```php
$p = basename($_GET['page'] ?? 'home');
$page_content = "content/{$p}.php";
include "../shared/layout.php";
```

---

## KILICHO HITAJI KUBORESHWA (Kwa Ujumla)

### A. Auth & Login (kabla ya dashboards)

| # | Tatizo | Suluhisho linalopendekezwa |
|---|--------|---------------------------|
| A1 | `login_process.php` hairuhusu/katai users wenye `status = 'pending'` | Baada ya `password_verify`, kagua `status === 'active'`; admin pekee aweze `active` moja kwa moja |
| A2 | Session haina `full_name`, `profile_image` | Ongeza kwenye login (kama `login_process_old.php`) ili topnav iweze kuonyesha jina |
| A3 | `last_login` haisasishwi | `UPDATE users SET last_login = NOW() WHERE id = ?` baada ya login |
| A4 | Hakuna uangalizi wa `phone_number` duplicate kwenye register | Ongeza check kama email (tayari kuna UNIQUE kwenye DB) |
| A5 | `profile_image` default haitofani | DB: `assets/images/default.jpg`, register: `default.png` — chagua moja, tumia kila mahali |
| A6 | `create_admin.php` ni script ya majaribio | Usitumie production; admin tayari yupo (`admin@onlinelabo.com`) |

### B. Database — mabadiliko yanayopendekezwa

**Hakuna haja ya kuunda database upya.** Boresha jedwali zilizopo na ongeza data ya msingi:

#### B1. Seed data (lazima kabla ya Patient/Lab dashboard)
```sql
-- test_categories (mfano)
INSERT INTO test_categories (category_name) VALUES
('Hematology'), ('Microbiology'), ('Urinalysis'), ('Serology');

-- lab_tests (mfano)
INSERT INTO lab_tests (category_id, test_name, description, price, duration) VALUES
(1, 'Full Blood Count', 'CBC panel', 25000.00, '24h'),
(1, 'Hemoglobin', 'Hb level', 15000.00, '6h'),
(2, 'Malaria Rapid Test', 'Malaria screening', 10000.00, '2h'),
(3, 'Urinalysis', 'Urine routine', 12000.00, '12h'),
(4, 'HIV Screening', 'HIV test', 20000.00, '24h');
```

#### B2. Ongeza column kwenye `appointments` (kuunganisha na lab)
```sql
ALTER TABLE appointments
  ADD COLUMN laboratory_id INT(11) NULL AFTER doctor_id,
  ADD KEY laboratory_id (laboratory_id),
  ADD CONSTRAINT appointments_ibfk_lab
    FOREIGN KEY (laboratory_id) REFERENCES laboratories(id);
```

#### B3. Ongeza `priority` (Lab dashboard inaonyesha Urgent/Normal)
```sql
ALTER TABLE appointments
  ADD COLUMN priority ENUM('normal','urgent') NOT NULL DEFAULT 'normal' AFTER status;
```

#### B4. Ongeza `notes` kwa appointment (hiari lakini muhimu kwa doctor/lab)
```sql
ALTER TABLE appointments
  ADD COLUMN notes TEXT NULL AFTER address;
```

#### B5. Sasisha `users.status` kwa watumiaji waliopo (ili waingie)
```sql
-- Baada ya admin kuapprove, au kwa majaribio:
UPDATE users SET status = 'active' WHERE role IN ('patient','doctor','labo') AND status = 'pending';
-- Admin tayari active (id 23)
```

#### B6. Futa duplicate index (hiari — usafi)
```sql
-- Kwenye users kuna UNIQUE mara mbili kwa phone_number (`phone` na `phone_number`)
-- Acha `phone_number` pekee
ALTER TABLE users DROP INDEX phone;
```

#### C. Ufafanuzi wa FK — **MUHIMU kwa queries**
- `appointments.patient_id` → `users.id` (SI `patients.id`)
- `appointments.doctor_id` → `users.id` (SI `doctors.id`)
- Kwa queries: tumia `$_SESSION['user_id']` moja kwa moja kama `patient_id` / `doctor_id`
- Kwa data ya patient (gender, dob): JOIN `patients ON patients.user_id = users.id`

#### D. Jedwali zisizotumika bado (Phase baadaye)
Hizi zipo kwenye DB lakini **usianguishe sasa** — zitatumika baadaye:
`activity_logs`, `audit_logs`, `email_verifications`, `password_resets`, `user_sessions`, `messages`, `support_tickets`, `doctor_referrals`, `lab_staff`, `prescriptions`, `payments`

---

## MUUNDO WA PHP (DRY) — Unda kabla ya dashboard 1

Usiandike SQL ndani ya kila `content/*.php`. Unda muundo huu:

```
includes/
  helpers.php           → escape(), redirect(), flash messages, formatDate()
  session_user.php      → getCurrentUserId(), requireRole()

repositories/           → (au models/) — SQL mahali pamoja
  UserRepository.php
  AppointmentRepository.php
  LabTestRepository.php
  TestResultRepository.php
  NotificationRepository.php
  LaboratoryRepository.php

actions/                → (process files) — pokea POST, piga repository, redirect
  admin/
    approve_user.php
    update_user_status.php
  patient/
    create_appointment_process.php
  labo/
    upload_result_process.php
  doctor/
    update_appointment_status.php
```

### Kanuni za DRY
1. **Repository moja = jedwali moja** (au group ndogo husika)
2. **Dashboard content** = HTML + kupiga repository + kuonyesha data tu
3. **Actions** = POST/GET processing pekee, hakuna HTML kubwa
4. **`active()` function** inarudiwa kwenye kila sidebar — hamisha kwenye `includes/helpers.php`:
   ```php
   function sidebarActive(string $page, string $current): string {
       return ($page === $current) ? 'bg-primary shadow-sm' : '';
   }
   ```
5. **`auth/auth.php`** — endelea kuita mwanzoni mwa kila dashboard; usiandike role check tena

---

## MPANGO WA KUTEKELEZAJA — DASHBOARD MOJA MOJA

> **Anza na:** Admin Dashboard → Patient → Lab → Doctor  
> **Sababu:** Admin huwezesha users (`pending` → `active`) na seed data (`lab_tests`). Bila hiyo, patient hawezi kufanya kazi vizuri.

---

## FASE 0 — Maandalizi (fanya kwanza)

- [ ] **0.1** Import `online_labo.sql` kwenye phpMyAdmin / MySQL (database: `online_labo`)
- [ ] **0.2** Hakikisha `config/db.php` ina credentials sahihi za XAMPP
- [ ] **0.3** Endesha SQL za **B1** (seed categories & tests) na **B2–B4** (columns mpya)
- [ ] **0.4** Unda folda `includes/`, `repositories/`, `actions/` kama juu
- [ ] **0.5** Rekebisha **A1–A3** kwenye `auth/login_process.php` (maelekezo tu — fanya unapofika hapa)
- [ ] **0.6** Jaribu login: `admin@onlinelabo.com` / `admin123` (kutoka `create_admin.php` comment)

---

## FASE 1 — ADMIN DASHBOARD

**Faili zilizopo:** `admin/dashboard.php`, `admin/content/home.php`, `users.php`, `add_user.php`, `delete.php`, `reject_user.php`  
**Faili zinazokosekana (sidebar inaziita):** `view_users`, `doctors`, `patients`, `lab_staff`, `suspend_users`, `activate_users`, `assign_roles`, `settings`, `notifications`

### Jedwali zinazohusika
| Jedwali | Matumizi |
|---------|----------|
| `users` | Orodha, idhini, suspend, activate |
| `patients`, `doctors`, `laboratories` | Maelezo ya ziada kwa kila role |
| `test_categories`, `lab_tests` | Usimamizi wa vipimo (seed + CRUD baadaye) |
| `activity_logs` | Log za admin (baadaye) |
| `system_settings` | Mipangilio (baadaye) |

### TODO — Admin

#### 1.1 Admin Home (`content/home.php`)
- [ ] Badilisha namba static (120, 25, 80…) kwa queries:
  - `COUNT(*)` kutoka `users` GROUP BY `role`
  - `COUNT(*)` kutoka `appointments`
  - `COUNT(*)` watumiaji wenye `status = 'pending'`
- [ ] **Repository:** `UserRepository::countByRole()`, `AppointmentRepository::countAll()`
- [ ] Recent activity: `SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT 10` (au users wapya `ORDER BY created_at DESC`)

#### 1.2 View / Manage Users (`content/users.php` — rekebisha sidebar: `view_users` → `users`)
- [ ] Orodha halisi: `SELECT id, full_name, email, role, status, created_at FROM users`
- [ ] Vitendo: Approve (`status='active'`), Reject/Suspend (`status='inactive'` au `'blocked'`)
- [ ] **Action:** `actions/admin/update_user_status.php` (POST: user_id, status)
- [ ] **Action:** `actions/admin/delete_user.php` — tumia soft delete (`inactive`) badala ya DELETE halisi (FK constraints)

#### 1.3 Add User (`content/add_user.php`)
- [ ] Fomu iwe na `action="../actions/admin/add_user_process.php"` (au tumia tena mantiki ya `register_process.php` kwa DRY — hamisha logic kwenye `UserRepository::register()`)

#### 1.4 Pending Users (kipengele muhimu — wengi wako `pending` kwenye DB)
- [ ] Unda `content/pending_users.php` AU ongeza filter kwenye `users.php`: `WHERE status = 'pending'`
- [ ] Admin akubali → `UPDATE users SET status='active'`

#### 1.5 Lab Tests Management (kipengele kipya — hakuna page bado)
- [ ] Unda `content/lab_tests.php` — CRUD kwa `test_categories` + `lab_tests`
- [ ] Ongeza kiungo sidebar chini ya "System"

#### 1.6 Kurasa za sidebar zisizopo
- [ ] Unda faili tupu zenye ujumbe "Coming soon" AU uondoe links kwenye `sidebars/admin.php` hadi zikamilike
- [ ] **Muhimu:** Rekebisha `view_users` → `users` kwenye sidebar

### PHP files kuzounda (Admin)
```
repositories/UserRepository.php
repositories/LabTestRepository.php
repositories/AppointmentRepository.php      (kwa counts tu)
actions/admin/update_user_status.php
actions/admin/add_user_process.php
actions/admin/delete_user.php               (soft delete)
```

### Lengo la Fase 1
Admin anaweza kuona watumiaji halisi, kuwawezesha (`active`), na kuhakikisha `lab_tests` zina data.

---

## FASE 2 — PATIENT DASHBOARD

**Faili zilizopo:** `home.php`, `create_appointment.php`, `view_appointments.php`, `appointment_history.php`, `view_test_results.php`

### Jedwali zinazohusika
| Jedwali | Matumizi |
|---------|----------|
| `users` | Taarifa za mgonjwa (session) |
| `patients` | gender, dob, address |
| `appointments` | Kuunda na kuona miadi |
| `appointment_tests` | Vipimo vilivyochaguliwa |
| `appointment_history` | Rekodi ya mabadiliko ya status |
| `doctors` + `users` | Orodha ya madaktari (kuchagua) |
| `laboratories` | Matawi / maabara |
| `lab_tests` | Orodha ya vipimo na bei |
| `test_results` | Matokeo ya vipimo |

### TODO — Patient

#### 2.1 Patient Home (`content/home.php`)
- [ ] Takwimu halisi kwa `patient_id = $_SESSION['user_id']`:
  - Jumla ya appointments
  - Pending / completed counts
  - Matokeo yaliyopo (`test_results` JOIN `appointments`)
- [ ] Jedwali "Recent Appointments" — data halisi kutoka DB
- [ ] Onyesha jina la mgonjwa kutoka session/DB

#### 2.2 Create Appointment (`content/create_appointment.php`) — **MUHIMU SANA**
- [ ] Fomu iwe `method="POST"` `action="../../actions/patient/create_appointment_process.php"`
- [ ] Sehemu za mgonjwa: **zijazwe kiotomatiki** kutoka session (usimwombe ajaze tena jina/email)
- [ ] Fields zinazohitajika kulingana na DB:
  - `appointment_date`, `appointment_time`
  - `type` → `'lab_test'` (default kwa mfumo huu)
  - `sample_collection` → `'home'` | `'lab'`
  - `address` → lazima ikiwa `home`
  - `doctor_id` → optional (dropdown kutoka `users WHERE role='doctor' AND status='active'`)
  - `laboratory_id` → dropdown kutoka `laboratories`
  - `test_ids[]` → checkbox/multiselect kutoka `lab_tests`
- [ ] **Action logic (transaction):**
  1. `INSERT INTO appointments (...)`
  2. `INSERT INTO appointment_tests` kwa kila test
  3. `INSERT INTO appointment_history` (status: pending, changed_by: user_id)
  4. Optional: `INSERT INTO notifications` kwa lab/doctor

#### 2.3 View Appointments (`content/view_appointments.php`)
- [ ] Query: appointments za mgonjwa huyu + JOIN doctor name + laboratory
- [ ] Onyesha status badges (pending, approved, completed, cancelled)
- [ ] Kitufe cha cancel: `actions/patient/cancel_appointment.php` (badilisha status tu)

#### 2.4 Appointment History (`content/appointment_history.php`)
- [ ] Query: `appointment_history` JOIN `appointments` WHERE patient = session user
- [ ] Onyesha nani alibadilisha (`changed_by` → users.full_name)

#### 2.5 View Test Results (`content/view_test_results.php`)
- [ ] **Rekebisha muundo** — ondoa `<head>`, `<body>` (vunja layout); acha HTML ya card tu
- [ ] Query: `test_results` JOIN `appointments` WHERE `patient_id = session user_id`
- [ ] Download: file kutoka `result_file` path (`assets/uploads/results/`)

### PHP files kuzounda (Patient)
```
repositories/AppointmentRepository.php    (expand)
repositories/TestResultRepository.php
actions/patient/create_appointment_process.php
actions/patient/cancel_appointment.php
```

### Lengo la Fase 2
Mgonjwa anaweza kuunda miadi halisi, kuiona, na kuona matokeo yanapopatikana.

---

## FASE 3 — LAB (LABO) DASHBOARD

**Faili zilizopo:** `labo/content/home.php` tu  
**Faili zinazokosekana (sidebar):** `test_requests`, `upload_results`, `patients`, `reports`, `notifications`

### Jedwali zinazohusika
| Jedwali | Matumizi |
|---------|----------|
| `laboratories` | Tambua lab ya mtumiaji: `WHERE user_id = $_SESSION['user_id']` |
| `appointments` | Maombi yaliyo `laboratory_id` = lab hii |
| `appointment_tests` + `lab_tests` | Aina ya vipimo |
| `users` + `patients` | Taarifa za mgonjwa |
| `sample_collections` | Hali ya sampuli |
| `test_results` + `result_details` | Kupakia matokeo |
| `notifications` | Arifa kwa patient/doctor |

### TODO — Lab

#### 3.1 Lab Home (`content/home.php`)
- [ ] Pata `laboratory_id` ya user aliyeingia
- [ ] Takwimu: pending/completed/rejected kutoka `appointments` + `sample_collections`
- [ ] Jedwali "Recent Test Requests" — data halisi

#### 3.2 Test Requests (`content/test_requests.php`) — **UNDA MPYA**
- [ ] Orodha: `appointments WHERE laboratory_id = ? AND status IN ('pending','approved')`
- [ ] Vitendo: Approve, Mark sample collected, Reject

#### 3.3 Upload Results (`content/upload_results.php`) — **UNDA MPYA**
- [ ] Chagua appointment iliyokamilika
- [ ] Pakia PDF/image → `assets/uploads/results/`
- [ ] `INSERT INTO test_results` + optional `result_details`
- [ ] Sasisha `appointments.status = 'completed'`
- [ ] **Action:** `actions/labo/upload_result_process.php`

#### 3.4 Sample Collections
- [ ] Unapokusanya sampuli: `INSERT/UPDATE sample_collections` (status: collected)
- [ ] `collector_id` = `$_SESSION['user_id']`

#### 3.5 Patients (`content/patients.php`)
- [ ] Orodha ya wagonjwa walio na appointments katika lab hii (DISTINCT patient_id)

#### 3.6 Reports & Notifications
- [ ] Phase baadaye — tumia `notifications` table

### PHP files kuzounda (Lab)
```
repositories/LaboratoryRepository.php
repositories/SampleCollectionRepository.php
repositories/TestResultRepository.php   (expand)
actions/labo/approve_appointment.php
actions/labo/collect_sample.php
actions/labo/upload_result_process.php
```

### Lengo la Fase 3
Maabara inaona maombi, hukusanya sampuli, na kupakia matokeo.

---

## FASE 4 — DOCTOR DASHBOARD

**Faili zilizopo:** `home.php`, `view_appointments.php`, `view_patients_list.php`  
**Faili zinazokosekana:** `appointment_action`, `request_labo_test`, `view_labo_results`, `create_prescription`

### Jedwali zinazohusika
| Jedwali | Matumizi |
|---------|----------|
| `appointments` | Miadi iliyo `doctor_id = session user` |
| `users` + `patients` | Orodha ya wagonjwa |
| `prescriptions` | Kuandika dawa |
| `doctor_referrals` | Kutuma mgonjwa kwenye vipimo |
| `test_results` | Kuona matokeo ya wagonjwa wake |
| `appointment_history` | Kumbukumbu za vitendo |

### TODO — Doctor

#### 4.1 Doctor Home (`content/home.php`)
- [ ] Takwimu halisi: appointments za leo, pending lab results, idadi ya wagonjwa
- [ ] Jedwali "Immediate Appointments" — kutoka DB
- [ ] Notifications kutoka `notifications WHERE user_id = ?`

#### 4.2 View Appointments (`content/view_appointments.php`)
- [ ] Filter: `WHERE doctor_id = $_SESSION['user_id']`
- [ ] Vitendo: approve, complete, cancel
- [ ] **Action:** `actions/doctor/update_appointment_status.php`

#### 4.3 View Patients List (`content/view_patients_list.php`)
- [ ] Wagonjwa walio na appointment na doctor huyu (DISTINCT)
- [ ] JOIN `patients` + `users` kwa maelezo kamili

#### 4.4 Appointment Action (`content/appointment_action.php`) — **UNDA MPYA**
- [ ] Badilisha status + andika `appointment_history`

#### 4.5 Request Lab Test (`content/request_labo_test.php`) — **UNDA MPYA**
- [ ] Unda appointment mpya ya `type='lab_test'` kwa mgonjwa aliyechaguliwa
- [ ] Au tumia `doctor_referrals` + appointment

#### 4.6 View Lab Results (`content/view_labo_results.php`) — **UNDA MPYA**
- [ ] Matokeo ya wagonjwa walio chini ya doctor huyu

#### 4.7 Create Prescription (`content/create_prescription.php`) — **UNDA MPYA**
- [ ] Fomu → `INSERT INTO prescriptions`
- [ ] **Action:** `actions/doctor/create_prescription_process.php`

### PHP files kuzounda (Doctor)
```
repositories/PrescriptionRepository.php
repositories/DoctorReferralRepository.php
actions/doctor/update_appointment_status.php
actions/doctor/create_prescription_process.php
actions/doctor/request_lab_test_process.php
```

### Lengo la Fase 4
Daktari anaona wagonjwa, miadi, anaidhinisha, anaomba vipimo, na kuona matokeo.

---

## FASE 5 — Vitu vya Pamoja (Baada ya dashboards kuwa na data)

- [ ] **Notifications** — `NotificationRepository` + kuonyesha count kwenye `shared/topnav.php`
- [ ] **Payments** — `payments` table (Phase ya malipo)
- [ ] **Activity / Audit logs** — log kila kitendo muhimu
- [ ] **Password reset** — `password_resets` table
- [ ] **Email verification** — `email_verifications` (production)
- [ ] **CSRF tokens** kwenye fomu zote za POST
- [ ] **Pagination** kwenye jedwali refu
- [ ] **Search** kwenye topnav (functional query)

---

## MUUNDO WA QUERY — MIFANO (kwa repositories)

### Mgonjwa — appointments zake
```sql
SELECT a.*, u.full_name AS doctor_name, l.labo_name
FROM appointments a
LEFT JOIN users u ON a.doctor_id = u.id
LEFT JOIN laboratories l ON a.laboratory_id = l.id
WHERE a.patient_id = ?
ORDER BY a.appointment_date DESC, a.appointment_time DESC
```

### Lab — maombi ya lab husika
```sql
SELECT a.*, u.full_name AS patient_name, p.phone_number
FROM appointments a
JOIN users u ON a.patient_id = u.id
WHERE a.laboratory_id = ?
  AND a.status IN ('pending', 'approved')
ORDER BY a.priority DESC, a.appointment_date ASC
```

### Admin — watumiaji wanasubiri idhini
```sql
SELECT id, full_name, email, role, status, created_at
FROM users
WHERE status = 'pending'
ORDER BY created_at DESC
```

---

## ORODHA YA UKAGUZI (Testing) — Baada ya kila fase

| Hatua | Jaribu |
|-------|--------|
| Register patient | Jisajili → angalia `users` + `patients` |
| Admin approve | Login admin → weka `active` → patient aingie |
| Patient book | Unda appointment + tests → angalia `appointments` + `appointment_tests` |
| Lab process | Login lab → ona ombi → collect → upload result |
| Doctor | Ona appointment → approve → ona matokeo |
| Logout | Session ifutwe, kurudi login |

---

## MUHTASARI WA PRIORITY

```
1. Fase 0  → DB seed + columns + muundo wa repositories
2. Fase 1  → Admin (approve users + lab_tests data)
3. Fase 2  → Patient (create/view appointments) ← moyo wa mfumo
4. Fase 3  → Lab (process + upload results)
5. Fase 4  → Doctor (appointments + prescriptions)
6. Fase 5  → Polish (notifications, payments, security)
```

---

## KUMBUKUMBU MUHIMU

1. **Usibadilishe database structure kubwa** bila backup — tumia `ALTER TABLE` tu kama ulivyoelezwa
2. **`appointments.patient_id` ni `users.id`** — si makosa ya DB, ni muundo uliouchagua; fuata hivyo kwenye code
3. **Dashboard content zote ni UI tu kwa sasa** — kazi kubwa ni kuunganisha repositories
4. **`view_test_results.php`** ina HTML kamili — irekebishe kabla ya kuunganisha DB
5. **Sidebar links nyingi zinaelekea kurasa zisizopo** — rekebisha au unda pages kwa mpangilio wa fases hapo juu
6. **DRY:** Usikope `register_process.php` kwenye `add_user` — tumia repository moja

---

*Faili hili lilitengenezwa kulingana na uchambuzi wa mfumo wa `onlinelabo_booking` na database `online_labo.sql`.*
*Hatua inayofuata: Anza na Fase 0, kisha Fase 1 (Admin Dashboard).*
