@extends('layouts.backend.master')
@section('title')
    Profile Saya
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row fv-plugins-icon-container">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="">
                            <div class="row">
                                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="John" autofocus="">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="Doe">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="john.doe@example.com" placeholder="john.doe@example.com">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Organization</label>
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="Pixinvent">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">US (+1)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            placeholder="202 555 0111">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <input class="form-control" type="text" id="state" name="state"
                                        placeholder="California">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode"
                                        placeholder="231465" maxlength="6">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save
                                    changes</button>
                                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false"
                            class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation">
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <button type="submit"
                                class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate
                                Account</button>
                            <input type="hidden">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
