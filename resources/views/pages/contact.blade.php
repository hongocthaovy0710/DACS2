@extends('layout')
@section('content')
   

<div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Đến ngay địa chỉ cửa hàng</h1>
                                <p class="mb-4">Bạn đang cần đặt một bó hoa tặng sinh nhật người thân, bạn bè? Gọi ngay 1900 633 045 để được tư vấn lựa chọn mẫu hoa hoặc đặt hoa sinh nhật giao nhanh trong 90 phút trên toàn quốc. </p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100"
                                    style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30672.53856242333!2d108.1989432256713!3d16.061996011856408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c77ba274d7%3A0xd681017dfff96d7f!2zUGFyaXMgZmxvd2VyIFNob3AgLSBD4butYSBow6FuZyBob2EgdMawxqFpIHThuqFpIMSQw6AgTuG6tW5n!5e0!3m2!1svi!2s!4v1717329539406!5m2!1svi!2s"
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form id="contactForm" action="#">
                                <input type="text" id="contactName" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name" required>
                                <input type="email" id="contactEmail" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email" required>
                                <textarea id="contactMessage" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message" required></textarea>
                                <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="button" onclick="validateContactForm()">Submit</button>
                            </form>
                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Address</h4>
                                    <p class="mb-2">180 Phan Châu Trinh Đà Nẵng</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Mail Us</h4>
                                    <p class="mb-2">nn@example.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-2">(+078) 3456 7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function validateContactForm() {
                let name = document.getElementById('contactName').value;
                let email = document.getElementById('contactEmail').value;
                let message = document.getElementById('contactMessage').value;
        
                if (name === "" || email === "" || message === "") {
                    alert("Please fill in all required fields.");
                    return false;
                }
        
                // Email format validation
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    alert("Please enter a valid email address.");
                    return false;
                }
        
                // If all validations pass, submit the form
                document.getElementById('contactForm').submit();
            }
        </script>

@endsection