{!! Theme::partial('header') !!}

<section class="section-about-hero" style="background-image: url({{Theme::asset()->url('images/about-bg.png')}})">
    <div class="header-bg-footer"></div>
</section>

<section class="section-about">
    <div class="container">
        <div class="section-about-wrapper row d-flex justify-content-between align-items-center">
            <div class="section-about-carousel d-md-block d-none">
                <img src="{{Theme::asset()->url('images/carousel-item-2.png')}}" alt="" class="img-fluid">
                <img src="{{Theme::asset()->url('images/carousel-item-4.png')}}" alt="" class="img-fluid">
                <img src="{{Theme::asset()->url('images/carousel-item-5.png')}}" alt="" class="img-fluid">
            </div>
            <div class="section-about-carousel-mobile owl-carousel owl-theme d-md-none d-block">
                <div class="item">
                    <img src="{{Theme::asset()->url('images/carousel-item-2.png')}}" alt="" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{Theme::asset()->url('images/carousel-item-4.png')}}" alt="" class="img-fluid">
                </div>
                <div class="item">
                    <img src="{{Theme::asset()->url('images/carousel-item-5.png')}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="section-about-text">
                <div class="section-about-text-inner">
                    <h2 class="site-title reverse"><span>O</span>VERVIEW</h2>
                    <p>Today’s Youth faces extraordinary global challenges, but we believe in the power of youths to enact change for a better world. We’re excited by the fresh new voices that are ready to speak up for a sustainable future. Point Avenue, with Netflix and the US Embassy, is hosting a public speaking competition for Vietnamese Youth, “Speak to Inspire, Vietnam”.</p>
                </div>
                <a href="javascript:;" class="main-button register-button">REGISTER NOW</a>
            </div>
        </div>
    </div>
</section>

<section class="section-about-eligible">
    <div class="container">
        <h2 class="site-title reverse">Eligibility</h2>
        <p class="text-center" style="margin-top: 35px">“Speak to Inspire, Vietnam” is open to Vietnamese youth around the world. Participants must provide proof of school enrollment and/or ID and be eligible in 3 categories listed below.</p>
        <div class="eligible-icon d-none d-md-flex justify-content-center">
            <div class="eligible-icon__item">
                <img src="{{Theme::asset()->url('images/icon-01.png')}}" alt="" class="img-fluid">
                <div class="eligible-icon__item--title">Junior</div>
                <p>Middle School (Grade 6 to 8)</p>
                <p>Age 11 to 13 (As of January 10, 2022)</p>
            </div>
            <div class="eligible-icon__item">
                <img src="{{Theme::asset()->url('images/icon-02.png')}}" alt="" class="img-fluid">
                <div class="eligible-icon__item--title">Senior</div>
                <p>High School (Grade 9 to 12)</p>
                <p>Age 14 to 17 (As of January 10, 2022)</p>
            </div>
            <div class="eligible-icon__item">
                <img src="{{Theme::asset()->url('images/icon-03.png')}}" alt="" class="img-fluid">
                <div class="eligible-icon__item--title">Youth</div>
                <p>University / Young Adults</p>
                <p>Age 18 to 24 (As of January 10, 2022)</p>
            </div>
        </div>


        <div class="eligible-icon d-block d-md-none justify-content-center">
            <div class="eligible-carousel owl-carousel owl-theme">
                <div class="item">
                    <div class="eligible-icon__item">
                        <img src="{{Theme::asset()->url('images/icon-01.png')}}" alt="" class="img-fluid">
                        <div class="eligible-icon__item--title">Junior</div>
                        <p>Middle School (Grade 6 to 8)</p>
                        <p>Age 11 to 13 (As of January 10, 2022)</p>
                    </div>
                </div>
                <div class="item">
                    <div class="eligible-icon__item">
                        <img src="{{Theme::asset()->url('images/icon-02.png')}}" alt="" class="img-fluid">
                        <div class="eligible-icon__item--title">Senior</div>
                        <p>High School (Grade 9 to 12)</p>
                        <p>Age 14 to 17 (As of January 10, 2022)</p>
                    </div>
                </div>
                <div class="item">
                    <div class="eligible-icon__item">
                        <img src="{{Theme::asset()->url('images/icon-03.png')}}" alt="" class="img-fluid">
                        <div class="eligible-icon__item--title">Youth</div>
                        <p>University / Young Adults</p>
                        <p>Age 18 to 24 (As of January 10, 2022)</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="site-title reverse">DETAILS</h2>
        <div class="eligible-table eligible-table-detail d-md-block d-none">
            <table>
                <thead>
                    <tr>
                        <td>STAGE</td>
                        <td>DETAILS</td>
                        <td>JUNIOR</td>
                        <td>SENIOR</td>
                        <td>YOUTH</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="3" class="td-border-right td-gradient-text">ROUND 1 (Online)</td>
                        <td>Video Submission</td>
                        <td colspan="3">10 January (Mon) 10:00AM ~ 16 February (Wed) 23:59PM (regular)</td>
                    </tr>
                    <tr>
                        <td>Voting & Evaluation</td>
                        <td colspan="3">19 February (Sat) 10:00AM ~ 28 February (Mon) 18:00PM</td>
                    </tr>
                    <tr>
                        <td>Announcement</td>
                        <td colspan="3">
                            <p>2 March (Wed) 12:00PM</p>
                            <ul>
                                <li>Top 20 Individuals (Speech)</li>
                                <li>Top 20 Individuals (Storytelling)</li>
                                <li>Top 20 Teams (Debate)</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td rowspan="4" class="td-border-right td-gradient-text">ROUND 2 (Online)</td>
                        <td>Speech</td>
                        <td>15 March (Tue)</td>
                        <td>16 March (Wed)</td>
                        <td>20 March (Sat)</td>
                    </tr>
                    <tr>
                        <td>Storytelling</td>
                        <td>17 March (Thu)</td>
                        <td>18 March (Fri)</td>
                        <td>20 March (Sat)</td>
                    </tr>
                    <tr>
                        <td>Debate</td>
                        <td>12 March (Sat)</td>
                        <td>13 March (Sun)</td>
                        <td>19 March (Sun)</td>
                    </tr>
                    <tr>
                        <td>Announcement</td>
                        <td colspan="3">
                            <p>21 March (Mon) 12:00PM</p>
                            <ul>
                                <li>Top 5 Individuals (Speech)</li>
                                <li>Top 5 Individuals (Storytelling)</li>
                                <li>Top 4 Teams (Debate)</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="td-gradient-text">TRAINING CAMP</td>
                        <td colspan="2">1 April (Fri) ~ 3 April (Sun)</td>
                    </tr>
                    <tr>
                        <td class="td-gradient-text">ROUND 3</td>
                        <td>Showcase</td>
                        <td colspan="3">9 April (Sat) ~ 10 April (Sun)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {!! Theme::partial('about.detail') !!}
    </div>
</section>

<section class="section-about-eligible">
    <div class="container">
        <h2 class="site-title reverse">T<span>O</span>PIC FOR ROUND 1</h2>
        <div class="eligible-table d-none d-md-block">
            <table>
                <thead>
                <tr>
                    <td></td>
                    <td>Junior </td>
                    <td>Senior </td>
                    <td>Youth </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Speech </td>
                    <td>
                        How does climate change affect your life?
                    </td>
                    <td>
                        Select an issue that relates to sustainability (e.g. coral reefs, biodiversity, urban development, natural disasters).
                        Why should this issue be prioritized in taking action?
                    </td>
                    <td>What does ‘sustainability’ mean?
                    </td>
                </tr>
                <tr>
                    <td class="text-uppercase">Storytelling </td>
                    <td>Imagine if the Earth could speak. What would they say?</td>
                    <td>[The year is 2122. As I woke up this morning, I…] Continue the story.</td>
                    <td>[The water was still.] Continue the story.</td>
                </tr>
                <tr>
                    <td class="text-uppercase">Debate </td>
                    <td>This House Would ban the use of private cars from city centers</td>
                    <td>This House Believes That environmental movements should concentrate their conservation efforts on protecting keystone species, even at the expense of other endangered species</td>
                    <td>This House Would lift patents on technologies designed to deal with environmental concerns</td>
                </tr>
                </tbody>
            </table>
        </div>

        {!! Theme::partial('about.topic-table') !!}
    </div>
</section>

{{--<section class="section-topic">--}}
{{--    <div class="container">--}}
{{--        <h2 class="site-title reverse text-right">T<span>O</span>PIC FOR ROUND 1</h2>--}}
{{--        <div class="topic-bg">--}}
{{--            <p>Will be announced on<br/> 10 Jan 2022. Stay tuned!</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<section class="section-about-eligible">
    <div class="container">
        <h2 class="site-title reverse">Evaluation</h2>
        <p class="text-center" style="margin-top: 35px">A panel of expert judges and coaches will evaluate the submitted videos based on the following evaluation standard:</p>
        <div class="eligible-icon d-none d-md-flex justify-content-center">
            <div class="eligible-icon__item justify-content-start">
                <img src="{{Theme::asset()->url('images/eva-icon-3.png')}}" alt="" class="img-fluid" style="max-width: 80px">
                <div class="eligible-icon__item--title">Content (40%)</div>
                <p>Overall flow and structure</p>
                <p>Reflective of one’s own unique perspectives</p>
                <p>Understanding of ‘Sustainability’ and the topic</p>
                <p>(Speech, Debate) Logic, Sufficient reasoning</p>
                <p>(Storytelling) Creativity, Sufficient description</p>
            </div>
            <div class="eligible-icon__item justify-content-start">
                <img src="{{Theme::asset()->url('images/eva-icon-2.png')}}" alt="" class="img-fluid" style="max-width: 80px">
                <div class="eligible-icon__item--title">Delivery (40%)</div>
                <p>Clear delivery and effective voice modulation (tone, volume, speed)</p>
                <p>Use of nuanced and vivid expressions</p>
                <p>Engagement with the audience/listener (Eye contact, Minimal reliance on notes)</p>
            </div>
            <div class="eligible-icon__item justify-content-start">
                <img src="{{Theme::asset()->url('images/eva-icon-1.png')}}" alt="" class="img-fluid" style="max-width: 80px">
                <div class="eligible-icon__item--title">Method (20%)</div>
                <p>Enthusiasm and passion for the topic (10%)</p>
                <p>Within time limit (10%)</p>
            </div>
        </div>


        <div class="eligible-icon d-block d-md-none justify-content-center">
            <div class="eligible-carousel owl-carousel owl-theme">
                <div class="item">
                    <div class="eligible-icon__item">
                        <img src="{{Theme::asset()->url('images/eva-icon-1.png')}}" alt="" class="img-fluid">
                        <div class="eligible-icon__item--title">Content (40%)</div>
                        <p>Overall flow and structure</p>
                        <p>Reflective of one’s own unique perspectives</p>
                        <p>Understanding of ‘Sustainability’ and the topic</p>
                        <p>(Speech, Debate) Logic, Sufficient reasoning</p>
                        <p>(Storytelling) Creativity, Sufficient description</p>
                    </div>
                </div>
                <div class="item">
                    <div class="eligible-icon__item">
                        <img src="{{Theme::asset()->url('images/eva-icon-2.png')}}" alt="" class="img-fluid">
                        <div class="eligible-icon__item--title">Delivery (40%)</div>
                        <p>Clear delivery and effective voice modulation (tone, volume, speed)</p>
                        <p>Use of nuanced and vivid expressions</p>
                        <p>Engagement with the audience/listener (Eye contact, Minimal reliance on notes)</p>
                    </div>
                </div>
                <div class="item">
                    <div class="eligible-icon__item">
                        <img src="{{Theme::asset()->url('images/eva-icon-3.png')}}" alt="" class="img-fluid">
                        <div class="eligible-icon__item--title">Method (20%)</div>
                        <p>Enthusiasm and passion for the topic (10%)</p>
                        <p>Within time limit (10%)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-coach" id="section-coach">
    <div class="container">
        <h2 class="site-title reverse text-uppercase">Judges &<br/>The C<span>o</span>aches </h2>
        <div class="section-subtext text-uppercase">Our Experts</div>
        <div class="coach-carousel owl-carousel owl-theme">
            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/hyewon-rho.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Hyewon Rho</div>
                        <div class="coach-info-text">
                            Hyewon is a coach and entrepreneur, driven by social impact and fueled by debate education. She serves as the CEO at Debate For All, Head of Debate Programs at Point Avenue, and the Head Coach of the Vietnamese national high school team for the World Schools Debating Championships (WSDC).
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/juseung.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Juseung Yi</div>
                        <div class="coach-info-text">
                            Juseung is an entrepreneur, facilitator, and best-selling author in communication and negotiation, whose life mission is to help people share ideas better. He is an education consultant sought out by major public and private institutions such as The Korea Economic Daily, BMW Korea, Korea Broadcasting System (KBS), and Seoul Office of Education.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/nhat-hung.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Nhat-Hung Nguyen</div>
                        <div class="coach-info-text">
                            Nhat Hung has been a pioneer and active community developer in the Vietnam debate scene. He is the Co-Founder and COO of Debate For All Vietnam and a Mentor for Debate Shows on Vietnam National Educational Channel (VTV7) such as "Trường Teen" or "The Debaters".
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/khanh-linh.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Khanh Linh Nguyen</div>
                        <div class="coach-info-text">
                            Khanh Linh is a young educator eager to take initiatives that empower the most vulnerable in society via debating. She is currently serving as a leader at her university, Diplomatic Academy of Vietnam, and as the Head of Marketing at Debate For All Vietnam.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/josua.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Joshua Park</div>
                        <div class="coach-info-text">
                            Joshua Park is an educator and administrator in debate, negotiation, entrepreneurship, and legal education. A graduate of Harvard Law School, he is currently the Dean of SolBridge International School of Business, serves on the Board of Directors for World Schools Debating Championships (WSDC), Ltd, and was the Chief Adjudicator of the WSDC in 2021.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/youngjae.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Youngjae Pak</div>
                        <div class="coach-info-text">
                            Youngjae is a debate coach and researcher at Debate For All who has recently completed his Master’s Degree in International Relations at the University of Chicago. He is a previous Korean National Debate Champion and has served on the adjudication core of the largest youth-level debating championships in Korea including YTN-HUFS Youth English Debating Championships and Gwangju Youth English Debating Championships.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/phan-my-linh.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">My-Linh Phan</div>
                        <div class="coach-info-text">
                            My-Linh Phan is an educator, a mother and life-long learner. Once a debater, and forever a believer in educating children on their rights as well as empowering them through self-advocacy, My-Linh co-found Vietnam Debate Association, bringing access to public speaking, research and debate training to both students and teachers around the country.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/sally-lee.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Sally Lee</div>
                        <div class="coach-info-text">
                            Sally is an Asian Champion and an Overall Best Speaker of Northeast Asia. She has served on the Adjudication Core of countless international and regional debating championships such as the Asian BP Debate Championship, United Asian Debate Championship, and Northeast Asian Debate Championship.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/dubey.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Abhisheka Dubey</div>
                        <div class="coach-info-text">
                            Abhisheka is a coach and educator in competitive debate, public speaking, critical thinking, and analysis of current affairs. As a scholar pursuing her PhD in Political Science at Seoul National University, she continues to find time to partake in things that she believes in; helping students constructively engage with issues around them through debate education.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/wen-yu-weng.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Wen-Yu Weng</div>
                        <div class="coach-info-text">
                            Wen-Yu Weng is a finance and strategy consultant with a focus on carbon and clean energy. She also serves as the Director of Taiwan Debate Union and the Debate Coach for Team Taiwan for World Schools Debating Championships (WSDC).
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/dahae-hong.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Da-Hea Hong</div>
                        <div class="coach-info-text">
                            An avid believer in the power of storytelling, Dahea spent her university years organizing and participating in debate competitions and coaching public speaking. She has then applied her passion into the business arena, pitching and negotiating to hundreds of clients for the past 10 years, as a sales strategist in companies such as Proctor & Gamble and Shutterstock.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/yaeseul-park.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Yaeseul Park</div>
                        <div class="coach-info-text">
                            Yaeseul is a Debate & Public Speaking Coach at Debate For All who first entered the world of debating in high school and has never left since. After her undergraduate studies at Georgetown and her masters at Seoul National University, she has been coaching and adjudicating for various events including debate camps, public speaking competitions, teacher training, and government programs across Korea.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/sam-brandy.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Sam Brady</div>
                        <div class="coach-info-text">
                            Sam serves on the coaching team of the Vietnamese national high school team for the World Schools Debating Championships (WSDC). His debate journey began in university where he won gold and silver medals at the California State and US National tournaments for forensics. Currently, Sam works primarily as a programmer but continues to coach in hopes of helping other young people learn and grow through debate like he was able to.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/zoda.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Jamick Ergash-Zoda</div>
                        <div class="coach-info-text">
                            Jamick is a seasoned debate coach who has been part of 60+ debating tournaments around the globe. He is a previous national champion as well as the champion of Asian English Olympics.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/lim.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Houymean Lim</div>
                        <div class="coach-info-text">
                            Houymean is two times Korean national champion. She is passionate about helping young learners improve their critical thinking and the art of persuasion through debate. She is co-founder of Khemera English Debate Society and the Head Coach of the Cambodian national high school team for the World Schools Debating Championships (WSDC).
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/juwon.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Juwon Park</div>
                        <div class="coach-info-text">
                            Juwon is a youth leader, event organizer, and experienced adjudicator and coach. She has served in leadership positions at Korea University College of International Studies as well as the Korea Intervarsity Debate Association (KIDA). She has organized and served on the adjudication core of multiple youth-level tournaments including Korea Youth Debate Championship and YTN-HUFS Youth Debate Championship.
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="coach-item">
                    <div class="coach-image">
                        <img src="{{Theme::asset()->url('images/seunghan.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="coach-info text-center">
                        <div class="coach-name">Seunghan Lee</div>
                        <div class="coach-info-text">
                            SeungHan believes debate is the most inspiring method of education. As a national finalist and northeast Asian semi-finalist, SeungHan has traveled near and far in organizing debating events and coaching students. He enjoys coaching students and continuously seeks to share and learn great ideas from them.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="coach-carousel-navigation">
            <a href="javascript:;" class="carousel-left"><i class="fa fa-chevron-left"></i></a>
            <a href="javascript:;" class="carousel-right"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</section>

<section class="section-organizers" style="margin-top: 100px" id="sectioin-organizers">
    <div class="section-award-circle"></div>
    <div class="container">
        <h2 class="site-title text-right reverse text-uppercase" id="section-organizers"><span>O</span>rganizers </h2>
        <div class="org-wrapper d-flex justify-content-between align-items-start flex-wrap">
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/org-logo-02.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    The U.S. government has invested millions of dollars in programs, such as the Mekong- U.S. partnership, to help communities identify solutions for food, water, and energy security. In Vietnam, the US Embassy has implemented several initiatives aimed at supporting Vietnamese youth development and along with the other partners to inspire and create innovative solutions to combat climate change.
                </div>
            </div>
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/org-logo-01.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    Netflix is the world's leading streaming entertainment service with 214 million paid memberships in over 190 countries enjoying TV series, documentaries, feature films and mobile games across a wide variety of genres and languages. Members can watch as much as they want, anytime, anywhere, on any Internet-connected screen. Members can play, pause and resume watching, all without commercials or commitments.
                </div>
            </div>
            <div class="org-item"></div>
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/org-logo-03.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    Point Avenue provides K-12 English learning, debate coaching, test preparation, admissions consulting, and life coaching across Southeast Asia. At Point Avenue, we use both character-based education and inquiry-based learning to provide students with tailored educational roadmaps.
                </div>
            </div>
        </div>
        <h2 class="site-title reverset reverse text-uppercase" id="section-sponsors">PARTNER</h2>
        <div class="org-wrapper spon-wrapper d-flex justify-content-between align-items-start flex-wrap">
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/spon-01.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    <b>Debate For All</b> is a Korea-based social venture specializing in debate education in English, Korean, Vietnamese and creating debate platforms across Asia. We believe that debate is a powerful tool of education that allows individuals to openly express their opinions and develop the skills of critical thinking and persuasion as well as to expand academic and career opportunities.
                </div>
            </div>
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/spon-02.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    <b>True North School</b> is a STEAM and bilingual school located in the north of Hanoi, Vietnam. Our aim is to provide the highest quality of academic and life-enriching programs that empower children through the “4 TNS Pillars”: Character Building, Academic Rigor, Physical Fitness and Global Citizenry through leadership.
                </div>
            </div>
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/spon-03.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    <b>Point Avenue Athena</b> is a Seoul, Korea based EdTech company founded in 2019. It provides a Classroom As A Service product to students, teachers and educational institutions throughout APAC.
                </div>
            </div>
            <div class="org-item">
                <div class="org-image">
                    <img src="{{Theme::asset()->url('images/spon-04.png')}}" alt="" class="img-fluid">
                </div>
                <div class="org-content">
                    <b>Cornerstone Institue (CSI)</b> is a private education company based in Ho Chi Minh City, Vietnam. We provide educational services for students from the early childhood through undergraduate university levels. With an experienced and passionate team, CSI is proud to be an international training center supporting students to realize their educational dreams and achieve their lifelong success.
                </div>
            </div>
        </div>
    </div>
</section>

{!! Theme::partial('footer') !!}
