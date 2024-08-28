
<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                <div class="my-5">
                    <form id="contactForm">
                        <div class="form-floating">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Enter your phone number..." data-sb-validations="required" />
                            <label for="phone">Phone Number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                        <br />
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center text-success mb-3">
                                <div class="fw-bolder">Form gönderimi başarılı!</div>
                                <br/>
                                <a href="https://startbootstrap.com/solution/contact-forms"></a>
                            </div>
                        </div>
                        <div class="d-none text-center text-danger fw-bolder mb-3" id="submitErrorMessage">Error sending message!</div>
                        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
