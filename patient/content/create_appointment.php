<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header bg-lab-gradient border-0 p-4 text-white text-center">
                    <h3 class="mb-1 fw-bold">Book Lab Appointment</h3>
                    <p class="mb-0 opacity-75">Fill in the details to schedule your test</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box rounded-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-info">Patient Information</h5>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <input type="text" class="form-control rounded-3 py-2" placeholder="Full Name">
                            </div>
                            <div class="col-md-6">
                                <input type="tel" class="form-control rounded-3 py-2" placeholder="Phone Number">
                            </div>
                            <div class="col-md-8">
                                <input type="email" class="form-control rounded-3 py-2" placeholder="Email Address">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select rounded-3 py-2">
                                    <option selected>Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="icon-box rounded-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar2-check-fill"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-info">Appointment Details</h5>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Preferred Date</label>
                                <input type="date" class="form-control rounded-3">
                            </div>
                            <div class="col-md-6">
                                <label class="small text-muted mb-1">Preferred Time</label>
                                <input type="time" class="form-control rounded-3">
                            </div>
                            <div class="col-md-6">
                                <select class="form-select rounded-3 py-2">
                                    <option selected>Select Branch</option>
                                    <option>Dar es Salaam</option>
                                    <option>Arusha</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select rounded-3 py-2" id="serviceType">
                                    <option value="walkin">Walk-in Visit</option>
                                    <option value="home">Home Collection</option>
                                </select>
                            </div>
                        </div>

                        <div id="homeFields" class="p-3 bg-light rounded-3 mb-4 border border-info border-opacity-25"
                            style="display:none;">
                            <input class="form-control mb-2 bg-white" placeholder="Street / House Number">
                            <input class="form-control bg-white" placeholder="Directions / Landmarks">
                        </div>

                        <button type="submit"
                            class="btn btn-info w-100 py-3 text-white fw-bold rounded-3 shadow-sm mt-3">
                            <i class="bi bi-check2-circle me-2"></i>Confirm Appointment
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('serviceType').addEventListener('change', function() {
    document.getElementById('homeFields').style.display = (this.value === 'home') ? 'block' : 'none';
});
</script>