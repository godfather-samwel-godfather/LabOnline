# CODE LIVE — Core Backend Implementation Guide

> **Lengo:** Mwongozo huu unaeleza kilichofanyika kwenye mfumo wako wa Online Labo Booking.
> Soma faili hili kama beginner ili uelewe muundo na jinsi ya kuongeza features mpya baadaye.

---

## 1. Muundo Mpya wa PHP (DRY)

```
onlinelabo_booking/
├── includes/
│   ├── bootstrap.php          ← Inapakiwa na dashboard.php (DB + helpers + repositories)
│   ├── action_bootstrap.php   ← Inapakiwa na actions/* (login check + DB)
│   ├── helpers.php            ← Functions za pamoja (e, redirect, flashMessage, statusBadge...)
│   └── session_user.php       ← getCurrentUserId(), requireRole(), requireLogin()
│
├── repositories/              ← SQL ziko hapa TU (hakuna SQL kwenye HTML)
│   ├── UserRepository.php
│   ├── AppointmentRepository.php
│   ├── LaboratoryRepository.php
│   ├── LabTestRepository.php
│   └── TestResultRepository.php
│
├── actions/                   ← POST handlers (hakuna HTML kubwa)
│   ├── admin/update_user_status.php
│   ├── patient/create_appointment_process.php
│   ├── labo/approve_appointment.php
│   └── labo/upload_result_process.php
│
├── admin/content/             ← UI + kuonyesha data kutoka repositories
├── patient/content/
├── labo/content/
└── doctor/content/
```

### Kanuni 3 za kukumbuka

| Sehemu | Kazi yake |
|--------|-----------|
| `content/*.php` | HTML ya dashboard + `foreach` ya data |
| `repositories/*.php` | SQL queries zote |
| `actions/*.php` | Pokea POST → repository → redirect |

---

## 2. Core Flow (Assessment Test)

```
Register (patient) → status = pending
        ↓
Admin login → Manage Users → Approve (status = active)
        ↓
Patient login → Create Appointment → view_appointments
        ↓
Labo login → Test Requests → Approve → Upload Results
        ↓
Doctor login → View Appointments + View Lab Results
```

---

## 3. Sidebar Core (Minimal)

| Role | Kurasa zinazofanya kazi |
|------|-------------------------|
| **admin** | `home`, `users`, `lab_tests` |
| **patient** | `home`, `create_appointment`, `view_appointments`, `view_test_results` |
| **labo** | `home`, `test_requests`, `upload_results` |
| **doctor** | `home`, `view_appointments`, `view_labo_results` |

---

## 4. Step-by-Step — Kilichofanyika

### STEP 1 — Admin Approve Users

**Action file:** `actions/admin/update_user_status.php`

**Input (POST):**
- `user_id` — ID ya user
- `status` — `active` | `inactive` | `blocked`

**SQL (kwenye UserRepository):**
```sql
UPDATE users SET status = ? WHERE id = ?
```

**UI:** `admin/content/users.php`
- Inaonyesha users halisi kutoka database
- Vitufe: Approve, Suspend, Block
- Kila kitufe kina `<form POST>` kwenda action file

**Jaribu:**
1. Login admin: `admin@onlinelabo.com` / `admin123`
2. Nenda **Manage Users**
3. Bofya **Approve** kwa patient aliye `pending`

---

### STEP 2 — Patient Create Appointment

**Action file:** `actions/patient/create_appointment_process.php`

**Input (POST):**
| Field | Jedwali |
|-------|---------|
| `laboratory_id` | `appointments.laboratory_id` → `laboratories.id` |
| `doctor_id` (optional) | `appointments.doctor_id` → `users.id` |
| `appointment_date` | `appointments.appointment_date` |
| `appointment_time` | `appointments.appointment_time` |
| `sample_collection` | `home` au `lab` |
| `address` | lazima ikiwa home collection |
| `test_ids[]` | `appointment_tests.test_id` |
| `priority` | `normal` au `urgent` |
| `notes` | optional |

**SQL (transaction — AppointmentRepository::create):**
```sql
-- 1. Insert appointment
INSERT INTO appointments
(patient_id, doctor_id, laboratory_id, appointment_date, appointment_time,
 type, sample_collection, address, status, priority, notes)
VALUES (?, ?, ?, ?, ?, 'lab_test', ?, ?, 'pending', ?, ?);

-- 2. Kwa kila test
INSERT INTO appointment_tests (appointment_id, test_id) VALUES (?, ?);

-- 3. History
INSERT INTO appointment_history (appointment_id, status, changed_by, notes)
VALUES (?, 'pending', ?, 'Appointment created by patient');
```

**Muhimu:**
- `patient_id` = `$_SESSION['user_id']` (si `patients.id`)
- `laboratory_id` inatoka `laboratories.id` (patient anachagua dropdown)

**UI:** `patient/content/create_appointment.php`
- UI yako haijabadilika sana — form sasa ina `action` na fields za DB

**Jaribu:**
1. Login patient (aliye approved)
2. **Create Appointment** → chagua lab, tarehe, tests
3. Angalia **View Appointments**

---

### STEP 3 — Labo Test Requests

**Page:** `labo/content/test_requests.php`

**SQL — pata lab id:**
```sql
SELECT id FROM laboratories WHERE user_id = ? LIMIT 1;
```

**SQL — orodha ya maombi:**
```sql
SELECT a.id, a.appointment_date, a.appointment_time, a.status, a.priority,
       u.full_name AS patient_name
FROM appointments a
JOIN users u ON u.id = a.patient_id
WHERE a.laboratory_id = ?
  AND a.status IN ('pending', 'approved')
ORDER BY a.priority DESC, a.appointment_date ASC;
```

**Approve action:** `actions/labo/approve_appointment.php`
```sql
UPDATE appointments SET status = 'approved' WHERE id = ?;
-- + appointment_history
```

**Jaribu:**
1. Login labo (`joansamwel2005@gmail.com` au user mpya wa labo)
2. **Test Requests** → ona ombi la patient
3. Bofya **Approve**

---

### STEP 4 — Labo Upload Result

**Action file:** `actions/labo/upload_result_process.php`

**Input:**
- `appointment_id`
- `result_file` (PDF/JPG/PNG)
- `remarks`

**Faili zinahifadhiwa:** `assets/uploads/results/`

**SQL (transaction — TestResultRepository):**
```sql
INSERT INTO test_results (appointment_id, uploaded_by, result_file, remarks, status)
VALUES (?, ?, ?, ?, 'uploaded');

UPDATE appointments SET status = 'completed' WHERE id = ?;

INSERT INTO appointment_history (appointment_id, status, changed_by, notes)
VALUES (?, 'completed', ?, 'Lab uploaded test result');
```

**UI:** `labo/content/upload_results.php`

**Jaribu:**
1. Labo → **Upload Results**
2. Chagua appointment → pakia PDF → Submit
3. Status inakuwa `completed`

---

### STEP 5 — Doctor View Results

**Page:** `doctor/content/view_labo_results.php`

**SQL:**
```sql
SELECT tr.id, tr.result_file, tr.remarks, tr.status, tr.uploaded_at,
       a.id AS appointment_id, p.full_name AS patient_name
FROM test_results tr
JOIN appointments a ON a.id = tr.appointment_id
JOIN users p ON p.id = a.patient_id
WHERE a.doctor_id = ?
ORDER BY tr.uploaded_at DESC;
```

**Muhimu:** Patient lazima achague **doctor** wakati wa booking ili doctor aone appointment na results.

**Jaribu:**
1. Patient abook na kuchagua doctor
2. Labo apakie result
3. Login doctor → **View Lab Results**

---

## 5. Login Improvements

**File:** `auth/login_process.php`

| Mabadiliko | Sababu |
|------------|--------|
| Kagua `status === 'active'` | Pending users wasiingie |
| `$_SESSION['full_name']` | Kuonyesha jina dashboard |
| `last_login` update | Rekodi ya login |
| Ujumbe wazi wa makosa | UX bora |

---

## 6. Jinsi ya Kuongeza Feature Mpya (Beginner Guide)

### Mfano: Ongeza "Cancel Appointment" kwa patient

**1. Ongeza method kwenye repository:**
```php
// repositories/AppointmentRepository.php
public function cancel(int $appointmentId, int $patientId): bool {
    // UPDATE status = 'cancelled' + history
}
```

**2. Unda action file:**
```php
// actions/patient/cancel_appointment.php
require_once __DIR__ . '/../../includes/action_bootstrap.php';
requireRole('patient');
// pokea appointment_id, piga repository, redirect
```

**3. Ongeza kitufe kwenye UI (content page):**
```html
<form method="POST" action="../actions/patient/cancel_appointment.php">
    <input type="hidden" name="appointment_id" value="...">
    <button type="submit">Cancel</button>
</form>
```

**4. Ongeza link sidebar** (ikiwa ni page mpya):
```html
<a href="dashboard.php?page=my_new_page">My Page</a>
```

**5. Unda** `content/my_new_page.php`

---

## 7. Quick Acceptance Test (Assessor)

| # | Hatua | Matarajio |
|---|-------|-----------|
| 1 | Register patient mpya | `users.status = pending` |
| 2 | Login admin → Approve | status = `active` |
| 3 | Login patient → Book appointment | rows kwenye `appointments`, `appointment_tests` |
| 4 | Login labo → Approve + Upload | `test_results` + status `completed` |
| 5 | Login doctor (aliyechaguliwa) | Anaona result |

---

## 8. Faili Zilizobadilishwa / Kuundwa

### Zilizoundwa (mpya)
- `includes/*` (4 files)
- `repositories/*` (5 files)
- `actions/admin/update_user_status.php`
- `actions/patient/create_appointment_process.php`
- `actions/labo/approve_appointment.php`
- `actions/labo/upload_result_process.php`
- `admin/content/lab_tests.php`
- `labo/content/test_requests.php`
- `labo/content/upload_results.php`
- `doctor/content/view_labo_results.php`

### Zilisasishwa (UI preserved)
- `admin/content/home.php`, `users.php`
- `patient/content/create_appointment.php`, `view_appointments.php`, `view_test_results.php`
- `labo/content/home.php`
- `doctor/content/view_appointments.php`
- `sidebars/admin.php`, `doctor.php`, `labo.php`, `patient.php`
- `*/dashboard.php` (bootstrap line)
- `auth/login_process.php`

---

## 9. Makosa ya Kawaida

| Tatizo | Suluhisho |
|--------|-----------|
| Patient hawezi login | Admin a-approve (`status = active`) |
| Labo haoni requests | Hakikisha `laboratory_id` imejazwa kwenye appointment |
| Doctor haoni results | Patient alichagua doctor wakati wa booking? |
| Hakuna tests kwenye form | Run seed SQL kwa `lab_tests` |
| Upload inashindwa | Hakikisha folder `assets/uploads/results/` ina write permission |

---

*Mwisho wa CODE LIVE — Core backend imekamilika. Features nyingine zifuata muundo huu huu.*
