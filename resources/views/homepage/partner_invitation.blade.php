<div class="hp-partner-invite">
    <div class="container">
        <h3 class="text-center font-weight-normal">{{ setting('fp_partner_invitation_title') }}</h3>
        <div class="row justify-content-center text-center my-4">
            <div class="col-md-6">{{ setting('fp_partner_invitation_subtitle') }}</div>
        </div>
        <div class="text-center"><a href="{{ route('partner.register') }}" class="btn btn-primary">{{ setting('fp_partner_invitation_button') }}</a></div>
    </div>
</div>
