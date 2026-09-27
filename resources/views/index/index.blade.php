@extends('layouts.app')

@section('title', 'PackiaApp — Smart Logistics & Delivery')

@section('content')
<style>
    :root{
        --packia:#01BFFF;
        --packia-dark:#062B3A;
        --packia-light:#E8F8FD;
        --ink:#10201d;
        --muted:#64736f;
        --line:#e7eeec;
        --white:#fff;
        --shadow:0 18px 50px rgba(6,43,58,.12);
    }
    .packia-home{font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:var(--ink);background:#fff}
    .packia-home *{box-sizing:border-box}
    .packia-nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.94);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}
    .packia-nav-inner,.packia-container{width:min(1180px,92%);margin:auto}
    .packia-nav-inner{height:76px;display:flex;align-items:center;justify-content:space-between;gap:25px}
    .packia-logo{height:42px;width:auto}
    .packia-links{display:flex;gap:25px;align-items:center}
    .packia-links a{color:var(--ink);text-decoration:none;font-size:14px;font-weight:600}
    .packia-links a:hover{color:var(--packia)}
    .packia-btn{display:inline-flex;align-items:center;justify-content:center;border:0;border-radius:12px;padding:13px 20px;background:var(--packia);color:#fff;text-decoration:none;font-weight:700;cursor:pointer;box-shadow:0 8px 22px rgba(1,191,255,.20)}
    .packia-btn:hover{background:var(--packia-dark);color:#fff}
    .packia-btn.alt{background:#fff;color:var(--packia);border:1px solid rgba(1,191,255,.22);box-shadow:none}
    .packia-hero{padding:78px 0 70px;background:radial-gradient(circle at 85% 20%,#c9f4ff 0,transparent 32%),linear-gradient(135deg,#eefaff 0%,#fff 58%,#f5fbff 100%)}
    .packia-hero-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:55px;align-items:center}
    .eyebrow{display:inline-flex;padding:8px 12px;border-radius:999px;background:var(--packia-light);color:var(--packia);font-weight:800;font-size:12px;text-transform:uppercase;letter-spacing:.08em}
    .packia-hero h1{font-size:clamp(42px,6vw,70px);line-height:1.02;margin:18px 0 20px;letter-spacing:-.045em}
    .packia-hero h1 span{color:var(--packia)}
    .packia-hero p{font-size:18px;line-height:1.75;color:var(--muted);max-width:650px}
    .hero-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:28px}
    .hero-card{background:#fff;border:1px solid var(--line);border-radius:26px;padding:26px;box-shadow:var(--shadow)}
    .hero-card h3{margin:0 0 8px;font-size:20px}
    .request-box{display:grid;gap:13px}
    .request-box label{font-size:12px;font-weight:800;color:var(--muted)}
    .request-box input,.request-box select{width:100%;border:1px solid var(--line);border-radius:11px;padding:13px;background:#fff;outline:none}
    .request-box input:focus,.request-box select:focus{border-color:var(--packia)}

    .packia-hero{position:relative;overflow:hidden}
    .hero-orbit{position:absolute;inset:-20% -10% auto auto;width:560px;height:560px;border:1px solid rgba(1,191,255,.18);border-radius:50%;pointer-events:none}
    .hero-orbit:before,.hero-orbit:after{content:"";position:absolute;border:1px solid rgba(1,191,255,.14);border-radius:50%}
    .hero-orbit:before{inset:65px}.hero-orbit:after{inset:130px}
    .hero-metrics{display:flex;gap:14px;flex-wrap:wrap;margin-top:30px}
    .metric{padding:12px 15px;background:rgba(255,255,255,.82);border:1px solid rgba(1,191,255,.16);border-radius:14px;box-shadow:0 8px 25px rgba(6,43,58,.05)}
    .metric strong{display:block;font-size:18px;color:var(--packia-dark)} .metric span{font-size:11px;color:var(--muted)}
    .request-box{position:relative}
    .request-status{display:flex;align-items:center;gap:8px;font-size:11px;font-weight:800;color:var(--packia);margin-bottom:15px}
    .pulse{width:8px;height:8px;border-radius:50%;background:var(--packia);box-shadow:0 0 0 6px rgba(1,191,255,.12)}
    .smart-strip{margin-top:22px;display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
    .smart-chip{padding:13px;border-radius:14px;background:#f7fcfe;border:1px solid #dceff5}
    .smart-chip b{display:block;font-size:12px}.smart-chip span{display:block;color:var(--muted);font-size:11px;margin-top:3px}
    .trust-band{background:var(--packia-dark);color:#fff;padding:18px 0}
    .trust-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}
    .trust-item{display:flex;gap:10px;align-items:center;font-size:13px}
    .trust-item b{display:block}.trust-item span{display:block;color:#b9d4dc;font-size:11px;margin-top:2px}
    .journey-wrap{position:relative}
    .journey-line{position:absolute;left:6%;right:6%;top:45px;height:2px;background:linear-gradient(90deg,var(--packia),#8be5fb,var(--packia));opacity:.35}
    .step{z-index:1}
    .step .step-number{box-shadow:0 0 0 7px #f7fcfe,0 0 0 8px rgba(1,191,255,.18)}
    .dashboard-card{background:#fff;border:1px solid var(--line);border-radius:26px;padding:25px;box-shadow:var(--shadow)}
    .dashboard-top{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:20px}
    .dashboard-title{font-size:13px;font-weight:800}.live-badge{font-size:10px;font-weight:800;color:var(--packia);background:var(--packia-light);padding:7px 10px;border-radius:999px}
    .route-map{height:240px;border-radius:20px;background:linear-gradient(145deg,#eefaff,#f8fcfd);position:relative;overflow:hidden;border:1px solid #e2f0f4}
    .route-map:before{content:"";position:absolute;inset:0;background-image:linear-gradient(25deg,transparent 48%,rgba(1,191,255,.12) 49%,transparent 51%),linear-gradient(145deg,transparent 48%,rgba(6,43,58,.08) 49%,transparent 51%);background-size:110px 90px}
    .route-path{position:absolute;left:14%;right:13%;top:50%;height:4px;background:var(--packia);transform:rotate(-8deg);border-radius:999px;box-shadow:0 0 20px rgba(1,191,255,.35)}
    .map-pin{position:absolute;width:16px;height:16px;border-radius:50%;background:var(--packia);border:4px solid #fff;box-shadow:0 0 0 5px rgba(1,191,255,.18)}
    .map-pin.one{left:12%;top:59%}.map-pin.two{right:11%;top:34%}
    .map-label{position:absolute;background:#fff;padding:8px 10px;border-radius:9px;box-shadow:0 7px 18px rgba(6,43,58,.09);font-size:10px;font-weight:800}
    .map-label.one{left:7%;top:69%}.map-label.two{right:4%;top:20%}
    .dashboard-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:12px}
    .dash-stat{padding:13px;background:#f8fbfb;border-radius:12px}.dash-stat small{color:var(--muted);font-size:10px}.dash-stat strong{display:block;margin-top:4px}
    .service-card{position:relative}
    .service-card:after{content:"↗";position:absolute;right:14px;top:14px;width:32px;height:32px;border-radius:50%;display:grid;place-items:center;background:rgba(255,255,255,.92);color:var(--packia);font-weight:900}
    .service-body h3{padding-right:25px}
    .mini-flow{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:25px;padding-top:20px;border-top:1px solid var(--line)}
    .mini-flow span{font-size:10px;font-weight:800;color:var(--muted);text-align:center}.mini-flow i{height:1px;flex:1;background:#cfe5eb}
    .mini-node{width:34px;height:34px;border-radius:10px;background:var(--packia-light);display:grid;place-items:center;color:var(--packia);font-style:normal}
    @media(max-width:900px){.trust-grid{grid-template-columns:repeat(2,1fr)}.journey-line{display:none}.smart-strip{grid-template-columns:1fr}.hero-orbit{width:400px;height:400px}}
    @media(max-width:600px){.trust-grid{grid-template-columns:1fr}.dashboard-stats{grid-template-columns:1fr}.hero-metrics{display:grid;grid-template-columns:1fr 1fr}}

    .section{padding:90px 0}
    .section.soft{background:#f7faf9}
    .section-head{text-align:center;max-width:760px;margin:0 auto 42px}
    .section-head h2{font-size:38px;line-height:1.15;margin:12px 0}
    .section-head p{color:var(--muted);line-height:1.75}
    .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
    .grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
    .card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:25px;transition:.25s;box-shadow:0 8px 25px rgba(6,43,58,.05)}
    .card:hover{transform:translateY(-4px);box-shadow:var(--shadow)}
    .icon{width:48px;height:48px;border-radius:14px;background:var(--packia-light);display:grid;place-items:center;color:var(--packia);font-size:22px;margin-bottom:18px}
    .card h3{margin:0 0 10px;font-size:19px}
    .card p{margin:0;color:var(--muted);line-height:1.65}
    .service-card{overflow:hidden;padding:0}
    .service-card img{width:100%;height:170px;object-fit:cover;display:block}
    .service-card .service-body{padding:21px}
    .process{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;counter-reset:step}
    .step{position:relative;padding:25px;background:#fff;border:1px solid var(--line);border-radius:18px}
    .step-number{width:38px;height:38px;border-radius:50%;background:var(--packia);color:#fff;display:grid;place-items:center;font-weight:800;margin-bottom:15px}
    .feature{display:grid;grid-template-columns:.9fr 1.1fr;gap:55px;align-items:center}
    .feature-panel{background:linear-gradient(145deg,var(--packia-dark),var(--packia));border-radius:28px;padding:40px;color:#fff;min-height:390px;display:flex;flex-direction:column;justify-content:center}
    .feature-panel h3{font-size:32px;margin:0 0 12px}
    .feature-panel p{color:#d9efea;line-height:1.7}
    .feature-list{display:grid;gap:18px}
    .feature-item{display:flex;gap:14px}
    .feature-item .icon{flex:none;margin:0}
    .feature-item h4{margin:0 0 5px}
    .feature-item p{margin:0;color:var(--muted);line-height:1.6}
    .cta{background:linear-gradient(135deg,var(--packia-dark),#074a5c);color:#fff;border-radius:30px;padding:55px;display:flex;justify-content:space-between;align-items:center;gap:30px}
    .cta h2{font-size:38px;margin:0 0 10px}
    .cta p{color:#cfe4df;margin:0}
    .footer{background:#071b18;color:#c7d8d4;padding:55px 0 25px}
    .footer-grid{display:grid;grid-template-columns:1.3fr 1fr 1fr 1fr;gap:35px}
    .footer h4{color:#fff;margin-top:0}
    .footer a{color:#c7d8d4;text-decoration:none;display:block;margin:9px 0}
    .footer-bottom{border-top:1px solid rgba(255,255,255,.1);margin-top:35px;padding-top:20px;font-size:13px;display:flex;justify-content:space-between}
    @media(max-width:900px){
        .packia-links{display:none}.packia-hero-grid,.feature{grid-template-columns:1fr}.grid-4,.process{grid-template-columns:repeat(2,1fr)}.grid-3{grid-template-columns:1fr 1fr}.footer-grid{grid-template-columns:1fr 1fr}
    }
    @media(max-width:600px){
        .packia-hero{padding:55px 0}.section{padding:65px 0}.grid-4,.grid-3,.process{grid-template-columns:1fr}.cta{padding:35px 25px;display:block}.cta .packia-btn{margin-top:22px}.footer-grid{grid-template-columns:1fr}.footer-bottom{display:block}
    }
</style>

<div class="packia-home">
    <nav class="packia-nav">
        <div class="packia-nav-inner">
            <a href="{{ url('/') }}"><img class="packia-logo" src="{{ asset('storage/fontwebsite/header-logo.png') }}" alt="PackiaApp"></a>
            <div class="packia-links">
                <a href="#services">Services</a>
                <a href="#how-it-works">How it works</a>
                <a href="#smart-logistics">Smart Logistics</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
            <a class="packia-btn" href="{{ url('/adminHub') }}">Create Shipment</a>
        </div>
    </nav>

    <header class="packia-hero">
        <div class="hero-orbit"></div>
        <div class="packia-container packia-hero-grid">
            <div>
                <span class="eyebrow">Smart logistics • Tanzania & beyond</span>
                <h1>Move anything.<br><span>Packia handles the journey.</span></h1>
                <p>
                    One intelligent logistics platform connecting customers, verified agents,
                    drivers and transport partners — with visibility from request to final delivery.
                </p>
                <div class="hero-actions">
                    <a class="packia-btn" href="{{ url('/adminHub') }}">Start a Shipment →</a>
                    <a class="packia-btn alt" href="#how-it-works">Explore the Journey</a>
                </div>
                <div class="hero-metrics">
                    <div class="metric"><strong>01</strong><span>Request</span></div>
                    <div class="metric"><strong>02</strong><span>Verify</span></div>
                    <div class="metric"><strong>03</strong><span>Assign</span></div>
                    <div class="metric"><strong>04</strong><span>Deliver</span></div>
                </div>
            </div>

            <div class="hero-card">
                <h3>Start a shipment request</h3>
                <p style="color:var(--muted);margin:0 0 20px">Tell us where the shipment starts and where it needs to go.</p>
                <div class="request-box">
                    <div><label>Pickup location</label><input type="text" placeholder="e.g. Moshi"></div>
                    <div><label>Destination</label><input type="text" placeholder="e.g. Mwanza"></div>
                    <div><label>Service type</label>
                        <select><option>Parcel / Cargo Delivery</option><option>Household Relocation</option><option>Business Delivery</option><option>International Shipping</option></select>
                    </div>
                    <a class="packia-btn" href="{{ url('/adminHub') }}">Continue Request →</a>
                </div>
            </div>
        </div>
    </header>

    <div class="trust-band">
        <div class="packia-container trust-grid">
            <div class="trust-item"><div class="icon" style="width:38px;height:38px;margin:0;background:rgba(255,255,255,.10);color:#fff">✓</div><div><b>Verified partners</b><span>Agents & drivers</span></div></div>
            <div class="trust-item"><div class="icon" style="width:38px;height:38px;margin:0;background:rgba(255,255,255,.10);color:#fff">⌁</div><div><b>Shipment tracking</b><span>Live status visibility</span></div></div>
            <div class="trust-item"><div class="icon" style="width:38px;height:38px;margin:0;background:rgba(255,255,255,.10);color:#fff">QR</div><div><b>Secure handover</b><span>Digital shipment identity</span></div></div>
            <div class="trust-item"><div class="icon" style="width:38px;height:38px;margin:0;background:rgba(255,255,255,.10);color:#fff">↗</div><div><b>Smart operations</b><span>Rules + real data</span></div></div>
        </div>
    </div>

    <section class="section" id="about">
        <div class="packia-container">
            <div class="section-head">
                <span class="eyebrow">Why PackiaApp?</span>
                <h2>We deliver trust, not just packages.</h2>
                <p>Built to simplify logistics and connect customers with efficient delivery solutions across Tanzania.</p>
            </div>
            <div class="grid-3">
                @foreach([
                    ['⚡','Fast & Reliable','Efficient delivery coordination with status updates and live tracking.'],
                    ['💰','Transparent Pricing','Clear quotations and flexible delivery options without hidden surprises.'],
                    ['📍','Nationwide Coverage','Connect cities, businesses and customers through a growing agent network.'],
                    ['🔐','Secure & Verified','Cargo handover, tracking and delivery confirmation create a clear chain of responsibility.'],
                    ['🧠','Smart Logistics','Route, driver and service decisions can use operational data and business rules.'],
                    ['🤝','Customer Focused','A support-driven journey designed around the customer from request to delivery.']
                ] as $item)
                    <article class="card">
                        <div class="icon">{{ $item[0] }}</div>
                        <h3>{{ $item[1] }}</h3>
                        <p>{{ $item[2] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section soft" id="services">
        <div class="packia-container">
            <div class="section-head">
                <span class="eyebrow">Our services</span>
                <h2>One platform. Multiple transport options.</h2>
                <p>Choose the transport that matches your cargo, distance, urgency and delivery requirements.</p>
            </div>
            <div class="grid-4">
                @foreach([
                    ['Motorcycle Delivery','Fast city delivery for small parcels','storage/fontwebsite/service-motorcycle1.jpg'],
                    ['Mini Pickup (Guta)','Efficient option for small business deliveries','storage/fontwebsite/Guta.jpg'],
                    ['Fuso Truck','Medium-to-heavy cargo and regional distribution','storage/fontwebsite/Fuso%20Truck3.jpg'],
                    ['Scania Long-Haul','Large-scale freight and long-distance logistics','storage/fontwebsite/Scania-Long-Haul.jpeg'],
                    ['Canter Cargo','Mid-size cargo transport for bulk deliveries','storage/fontwebsite/Canter%20Cargo.webp'],
                    ['Tandem Loader','Heavy-duty transport for construction materials','storage/fontwebsite/Tandem%20Loader.jpg'],
                    ['Kirikuu Van','Flexible transport for medium-sized goods','storage/fontwebsite/Kirikuu-Van1.jpg'],
                    ['Air & Ocean Freight','Domestic and international freight solutions','storage/fontwebsite/Air-Freight-Delivery.webp']
                ] as $service)
                    <article class="card service-card">
                        <img src="{{ asset($service[2]) }}" alt="{{ $service[0] }}">
                        <div class="service-body">
                            <h3>{{ $service[0] }}</h3>
                            <p>{{ $service[1] }}</p>
                            <div class="mini-flow">
                                <div><div class="mini-node">📦</div><span>Request</span></div><i></i>
                                <div><div class="mini-node">🚚</div><span>Move</span></div><i></i>
                                <div><div class="mini-node">✓</div><span>Deliver</span></div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="how-it-works">
        <div class="packia-container">
            <div class="section-head">
                <span class="eyebrow">The Packia journey</span>
                <h2>From request to confirmed delivery.</h2>
                <p>A simple customer journey backed by agents, verified transport partners and shipment tracking.</p>
            </div>
            <div class="process journey-wrap"><div class="journey-line"></div>
                @foreach([
                    ['1','Create Request','Customer provides pickup, destination, cargo details and photos where available.'],
                    ['2','Agent Assessment','The nearest suitable Packia agent reviews and verifies the shipment details.'],
                    ['3','Quote & Confirm','The shipment is assessed, the price is agreed and payment is confirmed.'],
                    ['4','Smart Assignment','A suitable pickup or transport partner is assigned based on availability and capability.'],
                    ['5','Secure Handover','Cargo is recorded with status, photos, QR/ID and timestamp at each key handover.'],
                    ['6','Track in Transit','Customer receives status updates while the shipment moves to its destination.'],
                    ['7','Destination Handover','Destination agent verifies the shipment and coordinates collection or last-mile delivery.'],
                    ['8','Proof of Delivery','Recipient confirms delivery using a secure verification method and the shipment is completed.']
                ] as $step)
                    <article class="step">
                        <div class="step-number">{{ $step[0] }}</div>
                        <h3>{{ $step[1] }}</h3>
                        <p style="color:var(--muted);line-height:1.6">{{ $step[2] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section soft" id="smart-logistics">
        <div class="packia-container">
            <div class="feature">
                <div class="feature-panel">
                    <span class="eyebrow" style="background:rgba(255,255,255,.12);color:#fff">Packia Smart Logistics</span>
                    <h3>Intelligent by design.</h3>
                    <p>
                        Packia can combine business rules, operational data and verified shipment events
                        to make better decisions about agents, drivers, routes, pricing and delivery options.
                    </p>
                    <a class="packia-btn alt" href="#contact" style="width:max-content">Partner with Packia</a>
                </div>
                <div class="feature-list">
                    @foreach([
                        ['🧭','Smart Agent Selection','Match a request with a suitable agent using location, availability, capability and operational performance.'],
                        ['🚚','Smart Driver Assignment','Consider vehicle capacity, route, availability, distance and verified performance before assigning a driver.'],
                        ['📦','Shipment Verification','Keep a digital chain of custody using shipment IDs, QR codes, photos, timestamps and handover records.'],
                        ['📍','Live Tracking & ETA','Keep customers informed through shipment statuses, location updates and estimated arrival information.'],
                        ['🛡️','Exception Management','Flag delays, failed pickups, damaged cargo or other incidents and route them to the right responsible party.'],
                        ['📊','Learning Loop','Use completed shipment data — cost, time, incidents and feedback — to improve future operational decisions.']
                    ] as $feature)
                        <div class="feature-item">
                            <div class="icon">{{ $feature[0] }}</div>
                            <div><h4>{{ $feature[1] }}</h4><p>{{ $feature[2] }}</p></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="packia-container">
            <div class="section-head">
                <span class="eyebrow">More flexibility</span>
                <h2>Built for different delivery needs.</h2>
                <p>Packia is designed to support everyday parcels, business logistics and larger relocation jobs.</p>
            </div>
            <div class="grid-3">
                <article class="card">
                    <div class="icon">🏠</div>
                    <h3>Household Relocation</h3>
                    <p>For customers moving from one home to another. Assessment can consider furniture, cargo volume, vehicle size, loading team and destination requirements.</p>
                </article>
                <article class="card">
                    <div class="icon">🏢</div>
                    <h3>Business & Bulk Delivery</h3>
                    <p>Coordinate recurring or bulk shipments with scheduled deliveries, multiple destinations and centralized shipment visibility.</p>
                </article>
                <article class="card">
                    <div class="icon">🌍</div>
                    <h3>Domestic & International</h3>
                    <p>Support regional transport as well as air and ocean freight workflows for shipments moving beyond Tanzania.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section" id="contact">
        <div class="packia-container">
            <div class="cta">
                <div>
                    <h2>Ready to move with Packia?</h2>
                    <p>Request a shipment, become a delivery partner, or talk to our team.</p>
                </div>
                <a class="packia-btn alt" href="mailto:info@packiaapp.com">Contact Packia</a>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top:25px;padding-bottom:90px">
        <div class="packia-container">
            <div class="cta">
                <div>
                    <span class="eyebrow" style="background:rgba(255,255,255,.10);color:#fff">One logistics ecosystem</span>
                    <h2>From a simple parcel to a complete house move.</h2>
                    <p>Packia is designed to coordinate people, vehicles, agents, payments and shipment events in one connected journey.</p>
                </div>
                <a class="packia-btn alt" href="{{ url('/adminHub') }}">Create Shipment</a>
            </div>
        </div>
    </section>

@include('layouts.templates.index_footer')
</div>
@endsection
