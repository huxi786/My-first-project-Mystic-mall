<x-app-layout>
    <!-- Professional Header Section -->
    <div class="position-relative bg-dark text-white py-5 mb-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=1920&auto=format&fit=crop'); background-size: cover; background-position: center; min-height: 300px; display: flex; align-items: center;">
        <div class="container text-center animate__animated animate__fadeInDown">
            <h1 class="display-3 fw-bold text-uppercase" style="letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Get in Touch</h1>
            <p class="lead text-light opacity-75">We'd love to hear from you. Let's start a conversation.</p>
            <div style="width: 60px; height: 4px; background-color: var(--accent-color); margin: 20px auto;"></div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-5 animate__animated animate__fadeInLeft">
                <div class="card card-custom h-100 border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="fw-bold mb-4 text-primary">Contact Information</h3>
                        <p class="text-muted mb-5">Have a question or just want to say hi? We'd love to hear from you.</p>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 btn-lg-square bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Our Location</h5>
                                <p class="text-muted mb-0">123 Mystic Avenue, Lahore, Pakistan</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 btn-lg-square bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-phone-alt fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Phone Number</h5>
                                <p class="text-muted mb-0">+92 300 1234567</p>
                                <small class="text-muted">Mon-Fri 9am-6pm</small>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 btn-lg-square bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Email Address</h5>
                                <p class="text-muted mb-0">support@mysticmall.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7 animate__animated animate__fadeInRight">
                <div class="card card-custom h-100 border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="fw-bold mb-4 text-primary">Send Message</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" class="form-control" placeholder="John Doe">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Your Email</label>
                                    <input type="email" class="form-control" placeholder="john@example.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" placeholder="Project Inquiry">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="5" placeholder="How can we help you?"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-mystic btn-lg w-100">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>