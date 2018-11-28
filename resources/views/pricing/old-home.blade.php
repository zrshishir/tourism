<div class="parallax-container">
    <div>
        <ul class="pricing_table">

            @foreach($packages as $key => $package)
            <li class="price_block">
                <h3>{{ $package->name }}</h3>
                <div class="price">
                    <div class="price_figure">
                        <span class="price_number">${{ $package->price }} </span>
                        <span class="price_tenure">per month</span>
                    </div>
                </div>
                <ul class="features">
                    <li>Validity {{$package->validity  }} Days</li>
                    <li>Limit {{ $package->limit }} Emails </li>

                </ul>
                <div class="footer">
                    <a href="{{ url('package'. '/'. $package->id )}}" class="action_button">Buy Now</a>
                </div>
            </li>
            <!-- end Starter -->
            @endforeach

            {{--<li class="price_block">--}}
                {{--<h3>Basic</h3>--}}
                {{--<div class="price">--}}
                    {{--<div class="price_figure">--}}
                        {{--<span class="price_number">$9.99</span>--}}
                        {{--<span class="price_tenure">per month</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<ul class="features">--}}
                    {{--<li>2GB Storage</li>--}}
                    {{--<li>5 Clients</li>--}}
                    {{--<li>10 Active Projects</li>--}}
                    {{--<li>10 Colors</li>--}}
                    {{--<li>Free Goodies</li>--}}
                    {{--<li>24/7 Email support</li>--}}
                {{--</ul>--}}
                {{--<div class="footer">--}}
                    {{--<a href="#" class="action_button">Buy Now</a>--}}
                {{--</div>--}}
            {{--</li>--}}
            <!-- end Basic -->


            <!-- end Premium -->


            <!-- end Lifetime -->
        </ul>


        <ul class="skeleton pricing_table" style="margin-top: 100px; overflow: hidden;">
            <li class="label" style="margin: 0;">ul.pricing_table</li>
            <li class="price_block">
                <span class="label">li.price_block</span>
                <h3><span class="label">h3</span></h3>
                <div class="price">
                    <span class="label">div.price</span>
                    <div class="price_figure">
                        <span class="label">div.price_figure</span>
          <span class="price_number">
            <span class="label">span.price_number</span>
          </span>
          <span class="price_tenure">
            <span class="label">span.price_tenure</span>
          </span>
                    </div>
                </div>
                <ul class="features">
                    <li class="label">ul.features</li>
                    <br/><br/><br/>
                </ul>
                <div class="footer">
                    <span class="label">div.footer</span>
                </div>
            </li>


            <li class="price_block" style="opacity: 0.5;">
                <span class="label">li.price_block</span>
                <h3><span class="label">h3</span></h3>
                <div class="price">
                    <span class="label">div.price</span>
                    <div class="price_figure">
                        <span class="label">div.price_figure</span>
          <span class="price_number">
            <span class="label">span.price_number</span>
          </span>
          <span class="price_tenure">
            <span class="label">span.price_tenure</span>
          </span>
                    </div>
                </div>
                <ul class="features">
                    <li class="label">ul.features</li>
                    <br/><br/><br/>
                </ul>
                <div class="footer">
                    <span class="label">div.footer</span>
                </div>
            </li>
            <li class="price_block" style="opacity: 0.25;">
                <span class="label">li.price_block</span>
                <h3><span class="label">h3</span></h3>
                <div class="price">
                    <span class="label">div.price</span>
                    <div class="price_figure">
                        <span class="label">div.price_figure</span>
          <span class="price_number">
            <span class="label">span.price_number</span>
          </span>
          <span class="price_tenure">
            <span class="label">span.price_tenure</span>
          </span>
                    </div>
                </div>
                <ul class="features">
                    <li class="label">ul.features</li>
                    <br/><br/><br/>
                </ul>
                <div class="footer">
                    <span class="label">div.footer</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="parallax"><img src="{{ asset('plugins/pricing/img/photo-4.jpg') }}" alt="Unsplashed background img 1">
    </div>
</div>