<?php

namespace Database\Seeders\Data;

use App\Models\School;

/**
 * Long-form HTML and SEO metadata for School of Chaplaincy /soc/{slug} programme pages.
 *
 * Placeholders __REGISTER__, __ADMISSIONS__, __FEES__, __FAQS__, __PROGRAMMES__ are replaced with escaped URLs.
 */
final class SocProgrammePageDefinitions
{
    /**
     * @return list<array{
     *     slug: string,
     *     title: string,
     *     excerpt: string,
     *     body: string,
     *     seo_title: string,
     *     seo_description: string,
     *     seo_keywords: string,
     *     og_title: string
     * }>
     */
    public static function all(School $soc): array
    {
        $register = htmlspecialchars(route('soc.register', [], false), ENT_QUOTES, 'UTF-8');
        $admissions = htmlspecialchars(route('schools.pages.show', [$soc, 'admissions']), ENT_QUOTES, 'UTF-8');
        $fees = htmlspecialchars(route('schools.pages.show', [$soc, 'fee']), ENT_QUOTES, 'UTF-8');
        $faqs = htmlspecialchars(route('schools.pages.show', [$soc, 'faqs']), ENT_QUOTES, 'UTF-8');
        $programmes = htmlspecialchars(route('schools.pages.show', [$soc, 'academic-programmes']), ENT_QUOTES, 'UTF-8');
        $diploma = htmlspecialchars(route('schools.pages.show', [$soc, 'diploma-in-chaplaincy']), ENT_QUOTES, 'UTF-8');
        $certificate = htmlspecialchars(route('schools.pages.show', [$soc, 'certificate-in-chaplaincy']), ENT_QUOTES, 'UTF-8');

        $sub = [
            '__REGISTER__' => $register,
            '__ADMISSIONS__' => $admissions,
            '__FEES__' => $fees,
            '__FAQS__' => $faqs,
            '__PROGRAMMES__' => $programmes,
            '__DIPLOMA__' => $diploma,
            '__CERTIFICATE__' => $certificate,
        ];

        $pages = [
            self::certificatePage(),
            self::diplomaPage(),
            self::healthcarePage(),
            self::militaryPage(),
            self::educationalPage(),
            self::policePage(),
            self::prisonPage(),
            self::futurePage(),
        ];

        foreach ($pages as &$p) {
            $p['body'] = strtr($p['body'], $sub);
        }
        unset($p);

        return $pages;
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function certificatePage(): array
    {
        return [
            'slug' => 'certificate-in-chaplaincy',
            'title' => 'Certificate in Chaplaincy',
            'excerpt' => 'Level 5 introductory chaplaincy qualification examined by CDACC — competency-based formation at Tenwek Hospital College for hospital, education, and institutional ministry.',
            'body' => <<<'HTML'
<p><strong>Certificate in Chaplaincy (Level 5)</strong> at Tenwek Hospital College is an introductory, competency-based pathway for men and women preparing to serve as chaplains in hospitals, schools, colleges, uniformed services, and other institutions. The qualification is examined by the <strong>Curriculum Development, Assessment and Certification Council (CDACC)</strong> and sits within Kenya’s Technical and Vocational Education and Training (TVET) framework, alongside the School of Chaplaincy’s wider mission to integrate spiritual care with real-world clinical and community contexts.</p>

<h2>Who this programme is for</h2>
<p>This Level 5 certificate is designed for applicants who meet the published entry threshold and want a structured foundation in chaplaincy before progressing to the Diploma. It suits:</p>
<ul>
<li>Applicants with <strong>KCSE D (Plain) and above</strong> who feel called to institutional chaplaincy</li>
<li>Church workers and volunteers moving into hospital, hospice, or school-based pastoral roles</li>
<li>Anyone seeking a <strong>CDACC-examined</strong> credential that signals credible, assessed competency in spiritual care</li>
</ul>

<h2>What you will learn</h2>
<p>Competency-based chaplaincy training focuses on what you can <em>do</em> in context—not only what you know. While exact unit titles follow the approved curriculum, learners typically grow in areas such as:</p>
<ul>
<li>Pastoral presence, listening, and crisis response in fast-paced environments</li>
<li>Ethical and respectful engagement across diverse faith backgrounds and worldviews</li>
<li>Collaboration with clinical, educational, and security-sector colleagues</li>
<li>Scripture-informed care that honours both doctrine and the dignity of each person</li>
</ul>
<p>The Certificate is designed as a <strong>build-up to the Diploma in Chaplaincy (Level 6)</strong>, so you can deepen formation and responsibility over time.</p>

<h2>Why study at Tenwek</h2>
<p>The School of Chaplaincy is embedded in the Tenwek Hospital College ecosystem—minutes from bedside realities, multidisciplinary rounds, and the spiritual needs of patients, families, and staff. That proximity shapes case-based learning, supervised reflection, and a community where theology meets the stress, grief, and hope found in African healthcare and education settings.</p>

<h2>Entry requirements and intakes</h2>
<p>Standard entry for the Certificate is <strong>KCSE D (Plain) and above</strong>. Admissions typically follow <strong>January, May, and September</strong> intakes; confirm current dates and any document checklist on our <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions page</a>.</p>

<h2>Fees and finance</h2>
<p>Tuition and trimester-related charges are published on the <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees page</a>. The school uses designated bank and M-Pesa channels—plan ahead so you can secure your place before each intake closes.</p>

<h2>How to apply</h2>
<p>If you are ready to begin, complete the <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">online registration</a> for the Certificate stream. For broader questions—documents, prerequisites, or campus life—browse <a class="font-semibold text-thc-royal hover:underline" href="__FAQS__">FAQs</a> or contact the School of Chaplaincy office using the details in the site header.</p>
HTML,
            'seo_title' => 'Certificate in Chaplaincy (Level 5) | School of Chaplaincy | Tenwek Hospital College',
            'seo_description' => 'CDACC Level 5 Certificate in Chaplaincy at Tenwek Hospital College: competency-based training for hospital, school & institutional chaplaincy. Entry KCSE D+. Apply online.',
            'seo_keywords' => 'Certificate in Chaplaincy, Level 5 chaplaincy, CDACC chaplaincy, Tenwek Hospital College chaplaincy, TVET chaplaincy Kenya, hospital chaplain training Bomet',
            'og_title' => 'Certificate in Chaplaincy (Level 5) at Tenwek Hospital College',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function diplomaPage(): array
    {
        return [
            'slug' => 'diploma-in-chaplaincy',
            'title' => 'Diploma in Chaplaincy',
            'excerpt' => 'Level 6 chaplaincy diploma: two years over six CDACC trimesters, preparing graduates for advanced pastoral responsibility in healthcare, education, and public service.',
            'body' => <<<'HTML'
<p>The <strong>Diploma in Chaplaincy (Level 6)</strong> at Tenwek Hospital College is an advanced competency-based programme for those who are ready to lead spiritual care initiatives, mentor peers, and serve confidently in complex institutions. Like the Certificate, it is examined by <strong>CDACC</strong> and integrates theology with the practical demands of chaplaincy in Kenya and beyond.</p>

<h2>Programme structure and timeline</h2>
<p>The Diploma is structured as <strong>two academic years delivered across six (6) trimesters</strong>. That rhythm allows concentrated blocks of coursework, supervised practice, and assessment while keeping learners close to the realities of hospital and community ministry surrounding Tenwek.</p>

<h2>Who should apply</h2>
<p>This Level 6 pathway fits:</p>
<ul>
<li>Graduates of the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate in Chaplaincy</a> who want deeper competency and responsibility</li>
<li>Applicants who meet the <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">diploma entry criteria</a> (including specified KCSE or equivalent benchmarks)</li>
<li>Experienced pastoral workers seeking a nationally examined credential aligned with TVET quality assurance</li>
</ul>

<h2>Competencies and outcomes</h2>
<p>Diploma-level formation emphasises advanced pastoral skills: trauma-informed care, interdisciplinary communication, ethical reasoning under pressure, teaching and small-group facilitation, and sustainable self-care. Graduates are equipped to chaplain within hospitals, hospices, schools, uniformed services, and NGOs where spiritual care is mission-critical.</p>

<h2>Learning environment</h2>
<p>Studying at Tenwek means learning beside a busy referral hospital, vibrant college community, and partners who value whole-person care. Case discussions draw from real (appropriately anonymised) scenarios, and faculty challenge learners to connect Scripture, culture, and professional standards.</p>

<h2>Fees, intakes, and admissions</h2>
<p>Review current trimester fees on the <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees page</a> and intake calendars on <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions</a>. January, May, and September remain common entry points—confirm the active cycle before you apply.</p>

<h2>Next steps</h2>
<p>Start with the admissions checklist, then submit the required forms and supporting documents. If you are exploring whether chaplaincy is your calling, read the <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">academic programmes overview</a> and reach out to the registrar with specific questions.</p>
HTML,
            'seo_title' => 'Diploma in Chaplaincy (Level 6) | School of Chaplaincy | Tenwek Hospital College',
            'seo_description' => 'Diploma in Chaplaincy (Level 6) at Tenwek: 2 years, 6 trimesters, CDACC-examined. Advanced hospital, school & institutional chaplaincy training in Bomet, Kenya.',
            'seo_keywords' => 'Diploma in Chaplaincy, Level 6 chaplaincy, CDACC diploma chaplaincy, Tenwek chaplaincy school, clinical pastoral education Kenya',
            'og_title' => 'Diploma in Chaplaincy (Level 6) | Tenwek Hospital College',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function healthcarePage(): array
    {
        return [
            'slug' => 'healthcare-chaplaincy',
            'title' => 'Healthcare Chaplaincy',
            'excerpt' => 'Spiritual care in hospitals, hospices, and healing environments — how Tenwek forms chaplains for bedside ministry, ethics rounds, and family support.',
            'body' => <<<'HTML'
<p><strong>Healthcare chaplaincy</strong> brings compassionate spiritual care to patients, families, and staff in hospitals, hospices, clinics, and community health programmes. At Tenwek Hospital College, healthcare chaplaincy is not an abstract specialty—it is learned in the shadow of active wards, busy outpatient corridors, and the pastoral needs that arise when people face birth, illness, trauma, and death.</p>

<h2>What healthcare chaplains do</h2>
<ul>
<li>Offer crisis presence, prayer, and ritual support respectful of each patient’s beliefs</li>
<li>Walk with families through diagnosis, treatment decisions, and bereavement</li>
<li>Partner with doctors, nurses, and social workers on ethics consults and goals-of-care conversations</li>
<li>Equip volunteers and local church partners to extend compassionate visitation</li>
</ul>

<h2>Formation pathways at Tenwek</h2>
<p>Most students enter through the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate</a> or <a class="font-semibold text-thc-royal hover:underline" href="__DIPLOMA__">Diploma in Chaplaincy</a>, where competencies apply directly to bedside and institutional contexts. Assignments, peer groups, and faculty mentoring emphasise cultural humility, infection-prevention etiquette, and documentation practices that integrate with hospital policy.</p>

<h2>Career relevance</h2>
<p>Graduates pursue roles as hospital chaplains, hospice spiritual care providers, mission hospital pastoral leaders, and community health chaplains. Employers increasingly expect chaplains who combine theological depth with communication skills suited to fast-moving clinical teams.</p>

<h2>Learn more and apply</h2>
<p>Explore every specialization on the <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">academic programmes</a> hub, then review <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions requirements</a>, <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees</a>, and <a class="font-semibold text-thc-royal hover:underline" href="__FAQS__">FAQs</a>. Certificate applicants may <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">register online</a>.</p>
HTML,
            'seo_title' => 'Healthcare Chaplaincy Training | School of Chaplaincy | Tenwek Hospital College',
            'seo_description' => 'Healthcare chaplaincy at Tenwek Hospital College: hospital & hospice spiritual care formation through CDACC chaplaincy programmes. Admissions, fees & FAQs.',
            'seo_keywords' => 'healthcare chaplaincy Kenya, hospital chaplain training, hospice chaplaincy course, Tenwek Hospital chaplaincy, clinical pastoral care Africa',
            'og_title' => 'Healthcare Chaplaincy | Tenwek School of Chaplaincy',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function militaryPage(): array
    {
        return [
            'slug' => 'military-chaplaincy',
            'title' => 'Military Chaplaincy',
            'excerpt' => 'Counseling and spiritual support for service members and families — competencies developed through Tenwek’s CDACC chaplaincy programmes.',
            'body' => <<<'HTML'
<p><strong>Military chaplaincy</strong> provides spiritual readiness, moral counsel, and pastoral care for personnel and families navigating deployment, transition, trauma, and loss. While national structures differ, the core skills mirror those of institutional chaplaincy elsewhere: trustworthy presence, ethical guidance, crisis intervention, and liaison with command teams.</p>

<h2>Competencies emphasised at Tenwek</h2>
<p>Through the School of Chaplaincy’s competency-based curriculum, learners strengthen:</p>
<ul>
<li>Trauma-informed listening and short-term supportive counseling</li>
<li>Religious accommodation and multi-faith facilitation in pluralistic settings</li>
<li>Family systems awareness during separation, reunion, and bereavement</li>
<li>Collaboration with medical and mental-health professionals</li>
</ul>

<h2>How this specialty connects to our programmes</h2>
<p>Military chaplaincy is introduced as a <strong>specialised area</strong> within the broader <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">academic programmes</a> catalogue. Students ground their calling in the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate</a> and <a class="font-semibold text-thc-royal hover:underline" href="__DIPLOMA__">Diploma</a> pathways, then apply learning to contexts such as uniformed services, peacekeeping chaplaincies, and veterans’ support networks.</p>

<h2>Explore admissions</h2>
<p>Review <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions</a> for entry criteria, intake calendars, and documentation. Certificate candidates can begin with <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">online registration</a>; all students should confirm fee schedules on the <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees page</a>.</p>
HTML,
            'seo_title' => 'Military Chaplaincy Studies | School of Chaplaincy | Tenwek Hospital College',
            'seo_description' => 'Military chaplaincy specialty at Tenwek: spiritual care for service members & families via CDACC Certificate & Diploma pathways. Fees, admissions & apply.',
            'seo_keywords' => 'military chaplaincy training Kenya, armed forces chaplain course, deployment pastoral care, Tenwek chaplaincy',
            'og_title' => 'Military Chaplaincy | Tenwek School of Chaplaincy',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function educationalPage(): array
    {
        return [
            'slug' => 'educational-chaplaincy',
            'title' => 'Educational Chaplaincy',
            'excerpt' => 'Chaplaincy in schools, colleges, and universities — spiritual care for students, educators, and staff across the education lifecycle.',
            'body' => <<<'HTML'
<p><strong>Educational chaplaincy</strong> serves learners and educators from primary school through higher education. Chaplains nurture spiritual formation, mediate conflict, support student wellbeing initiatives, and help institutions honour both missional identity and pluralism in the classroom.</p>

<h2>Core responsibilities</h2>
<ul>
<li>Leading assemblies, chapel services, or voluntary faith gatherings</li>
<li>Providing confidential pastoral care for students and staff</li>
<li>Partnering with counselors on crisis protocols and safeguarding</li>
<li>Equipping faculty to engage faith questions with respect and clarity</li>
</ul>

<h2>Training at Tenwek Hospital College</h2>
<p>The School of Chaplaincy introduces educational chaplaincy as a <strong>specialised area</strong> linked to the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate</a> and <a class="font-semibold text-thc-royal hover:underline" href="__DIPLOMA__">Diploma</a> programmes. Learners practise skills in community settings while benefiting from Tenwek’s hospital-adjacent context, where pastoral care intersects with high-stakes communication daily.</p>

<h2>Start your application</h2>
<p>Browse the full <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">programme listing</a>, read <a class="font-semibold text-thc-royal hover:underline" href="__FAQS__">FAQs</a>, and confirm finances via the <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees page</a>. Certificate applicants may <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">register online</a>; diploma candidates should follow the checklist on <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions</a>.</p>
HTML,
            'seo_title' => 'Educational Chaplaincy | School Chaplain Training | Tenwek Hospital College',
            'seo_description' => 'Educational chaplaincy specialty: school & university spiritual care through Tenwek’s CDACC chaplaincy programmes. View admissions, fees & course links.',
            'seo_keywords' => 'school chaplain Kenya, educational chaplaincy training, campus ministry course, college chaplain qualification',
            'og_title' => 'Educational Chaplaincy | Tenwek School of Chaplaincy',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function policePage(): array
    {
        return [
            'slug' => 'police-chaplaincy',
            'title' => 'Police Chaplaincy',
            'excerpt' => 'Spiritual care and counseling for police officers, staff, and families — grounded in Tenwek’s competency-based chaplaincy curriculum.',
            'body' => <<<'HTML'
<p><strong>Police chaplaincy</strong> offers spiritual support, crisis ministry, and confidential pastoral care for law-enforcement personnel, civilian staff, and their households. Chaplains often respond after critical incidents, line-of-duty trauma, and cumulative stress that affects entire families.</p>

<h2>Essential skills</h2>
<ul>
<li>Rapid spiritual assessment and short-term crisis presence</li>
<li>Peer-support coordination and referral to mental-health services</li>
<li>Ethical counsel honouring both public trust and officer wellbeing</li>
<li>Community bridge-building between police agencies and faith communities</li>
</ul>

<h2>How Tenwek prepares police chaplains</h2>
<p>Learners pursue the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate</a> or <a class="font-semibold text-thc-royal hover:underline" href="__DIPLOMA__">Diploma in Chaplaincy</a>, using the <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">specialised areas</a> catalogue—including police chaplaincy—to contextualise assignments. Faculty emphasise confidentiality, cultural competence, and sustainable boundaries for high-demand roles.</p>

<h2>Admissions and fees</h2>
<p>Review <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions</a> for intake cycles and documentation, and the <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees page</a> for the latest trimester schedule. Certificate students may launch the process through <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">online registration</a>.</p>
HTML,
            'seo_title' => 'Police Chaplaincy Training | School of Chaplaincy | Tenwek Hospital College',
            'seo_description' => 'Police chaplaincy track at Tenwek Hospital College: CDACC chaplaincy programmes for law-enforcement spiritual care. Fees, admissions & registration.',
            'seo_keywords' => 'police chaplain Kenya, law enforcement chaplaincy training, critical incident pastoral care, Tenwek chaplaincy',
            'og_title' => 'Police Chaplaincy | Tenwek School of Chaplaincy',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function prisonPage(): array
    {
        return [
            'slug' => 'prison-chaplaincy',
            'title' => 'Prison (correctional ministry) chaplaincy',
            'excerpt' => 'Pastoral care in prisons, borstals, rehabilitation schools, and probation — restorative chaplaincy through Tenwek’s CDACC pathways.',
            'body' => <<<'HTML'
<p><strong>Prison and correctional ministry chaplaincy</strong> serves inmates, correctional officers, and families affected by incarceration. Chaplains facilitate worship, discipleship, restorative encounters, and re-entry planning while navigating security protocols and diverse religious rights.</p>

<h2>Ministry contexts</h2>
<ul>
<li>Men’s and women’s prisons and remand facilities</li>
<li>Borstal and youth rehabilitation centres</li>
<li>Probation departments and community corrections programmes</li>
</ul>

<h2>Formation focus</h2>
<p>Tenwek’s programmes cultivate resilience, ethical clarity, and trauma-aware communication—skills essential when ministering in high-control environments. Learners connect classroom theory with supervised practice and case studies drawn from African correctional realities.</p>

<h2>Programme links</h2>
<p>Start with the <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">academic programmes</a> overview, then choose the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate</a> or <a class="font-semibold text-thc-royal hover:underline" href="__DIPLOMA__">Diploma</a>. Confirm entry criteria on <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions</a>, tuition on <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees</a>, and common questions on <a class="font-semibold text-thc-royal hover:underline" href="__FAQS__">FAQs</a>. Certificate applicants may <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">register online</a>.</p>
HTML,
            'seo_title' => 'Prison & Correctional Chaplaincy | Tenwek Hospital College',
            'seo_description' => 'Correctional ministry chaplaincy at Tenwek: training for prison, borstal & probation pastoral care via CDACC chaplaincy programmes. Admissions & fees.',
            'seo_keywords' => 'prison chaplain Kenya, correctional ministry training, borstal chaplaincy, restorative chaplaincy course',
            'og_title' => 'Prison Chaplaincy | Tenwek School of Chaplaincy',
        ];
    }

    /**
     * @return array{slug: string, title: string, excerpt: string, body: string, seo_title: string, seo_description: string, seo_keywords: string, og_title: string}
     */
    private static function futurePage(): array
    {
        return [
            'slug' => 'future-chaplaincy-programmes',
            'title' => 'Future programmes',
            'excerpt' => 'Emerging chaplaincy specialties and advanced study levels envisioned by the School of Chaplaincy at Tenwek Hospital College.',
            'body' => <<<'HTML'
<p>The School of Chaplaincy continually discerns how to expand <strong>specialty training</strong> and advanced credentials that keep pace with Kenya’s TVET reforms and the global growth of professional chaplaincy. Future programming may include deeper clinical pastoral education, digital chaplaincy competencies, and new collaborations with regional seminaries and healthcare systems.</p>

<h2>Why this matters</h2>
<p>Chaplains today serve in aerospace, corporate, humanitarian, and cyber-enabled ministries—not only traditional hospitals and schools. Tenwek’s leadership monitors CDACC guidance, employer expectations, and student feedback to prioritise the next wave of courses.</p>

<h2>Stay connected</h2>
<p>While future offerings are under development, you can still pursue the <a class="font-semibold text-thc-royal hover:underline" href="__CERTIFICATE__">Certificate</a>, <a class="font-semibold text-thc-royal hover:underline" href="__DIPLOMA__">Diploma</a>, and every <a class="font-semibold text-thc-royal hover:underline" href="__PROGRAMMES__">specialised area</a> currently advertised. Subscribe to college news, monitor the admissions desk for announcements, and direct specific ideas to the School of Chaplaincy registrar.</p>

<h2>Plan your studies today</h2>
<p>Review <a class="font-semibold text-thc-royal hover:underline" href="__ADMISSIONS__">admissions</a>, <a class="font-semibold text-thc-royal hover:underline" href="__FEES__">fees</a>, and <a class="font-semibold text-thc-royal hover:underline" href="__FAQS__">FAQs</a>. Certificate candidates may <a class="font-semibold text-thc-royal hover:underline" href="__REGISTER__">register online</a> to secure the next available intake.</p>
HTML,
            'seo_title' => 'Future Chaplaincy Programmes | Tenwek Hospital College',
            'seo_description' => 'Future chaplaincy programmes at Tenwek School of Chaplaincy: planned specialties & advanced study. Explore current CDACC Certificate & Diploma pathways.',
            'seo_keywords' => 'future chaplaincy courses Kenya, Tenwek chaplaincy expansion, CDACC chaplaincy updates',
            'og_title' => 'Future Chaplaincy Programmes | Tenwek',
        ];
    }
}
