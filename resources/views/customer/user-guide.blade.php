@extends('customer.template.layout')

@section('title')
    {{__('User Guide')}}
@endsection

@section('css')

<style>
    #accordionOne .accordion-button, 
    #accordionTwo .accordion-button,
    #accordionThree .accordion-button,
    #accordionFour .accordion-button,
    #accordionFive .accordion-button,
    #accordionSix .accordion-button,
    #accordionSeven .accordion-button {
    background-color: #3EB780;
    color: white;
}

#accordionOne .accordion-body,
 #accordionTwo .accordion-button,
    #accordionThree .accordion-button,
    #accordionFour .accordion-button,
    #accordionFive .accordion-button,
    #accordionSix .accordion-button,
    #accordionSeven .accordion-button, {
    color: #222;
}

#accordionOne .accordion-button::after,
#accordionTwo .accordion-button::after,
#accordionThree .accordion-button::after,
#accordionFour .accordion-button::after,
#accordionFive .accordion-button::after,
#accordionSix .accordion-button::after,
#accordionSeven .accordion-button::after {
    filter: brightness(0) invert(1); /* Turns it white */
}

</style>

@endsection

@section('content')
<div class="content">
    <div class="content container-fluid">
       <!-- Tabs -->
       <section class="comp-section">
        <div class="section-header">
            <h3 class="section-title">User Guide</h3>
            <div class="line"></div>
        </div>

        	<div class="row">
                <div class="card-body">

                    <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionOne">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                               Application Submission
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                                <div class="accordion-body text-muted">
                                    Once an application is successfully submitted, proponent would be required to pay a non-refundable processing fee of .
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionTwo">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Upload Document
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                                <div class="accordion-body text-muted">
                                    At this step, you need to upload all the required documents specified in the checklist. 
                                    Ensure that each document is in the correct format (pdf) and meets the required file size 
                                    limits. Double-check that you have uploaded all necessary documents.
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionThree">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                Job Assignment & Inspection
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree">
                                <div class="accordion-body text-muted">
                                    Once processing fee is paid, the job will be assigned to an Inspector. The designated Inspector shall visit the premises/location of the proposed project site for Inspection.  
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionFour">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                Bill Generation
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour">
                                <div class="accordion-body text-muted">
                                    Once an inspection is completed and inspection report is submitted, the system will generate a bill based on the inspection details. 
                                    Review the bill carefully to verify that all charges are accurate. If there are any discrepancies, reach out to Accounts Office for assistance. 
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionFive">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    Payment
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive">
                                <div class="accordion-body text-muted">
                                    Proceed to make the payment using the available and your preferred payment methods. Ensure that the payment information you provide is correct to avoid any delays. 
                                    Once the payment is successful, the next stage will be the review of application with the necessary documents. Copies of receipt on each payment is available on the customer’s Portal for review and printing.
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionSix">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    Approval
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse show" aria-labelledby="headingSix">
                                <div class="accordion-body text-muted">
                                   Once all previous steps are completed and approval for issuance of Permit granted, 
                                   you will receive an notification of approval of your application. A copy of your digital certificate will be available on your Customer Information Portal (CIP) for download.
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                     <div class="card mb-3">
                        <div class="accordion accordion-flush" id="accordionSeven">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    Tracking of Application
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse show" aria-labelledby="headingSeven">
                                <div class="accordion-body text-muted">
                                   Proponent(s) can track their application(s) to know where application is at any point of the application processes. 
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                </div>
	
									
								</div>
        
    </section>
    <!-- /Tabs -->
        
    
    </div
</div>

@endsection