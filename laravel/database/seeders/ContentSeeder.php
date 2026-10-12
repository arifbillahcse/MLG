<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $home = [
            ['Which language should I choose?',
             "Choose the country first, then the language follows. Japan needs JLPT, Korea needs TOPIK, China needs HSK — and if you are aiming at an English-taught programme anywhere, you need IELTS instead. We work this out with you in the free consultation rather than selling you a course you don't need."],
            ['Is the online course the same as the in-class one?',
             'Same syllabus, same instructors, same certificate, same mock tests. The differences are live doubt-solving (weekly online, every class in person) and speaking practice (scheduled calls online, daily with classmates in person). Online access lasts twelve months so you can replay any lesson.'],
            ['What proficiency level do universities actually require?',
             'Japanese language schools generally accept JLPT N5; Japanese-taught degrees want N2. Korean universities usually ask for TOPIK 3–4 for degree programmes. Chinese-taught programmes typically want HSK 4, though many CSC scholarship courses are taught in English. We plan your language timeline backwards from the intake you are targeting.'],
            ['What does the whole process cost, honestly?',
             'Course fees are published on this page. Beyond that, budget for exam registration, the embassy visa fee, an air ticket, insurance and the first semester tuition paid directly to the institution. Study-abroad service charges are quoted after your consultation, in writing, before you commit to anything.'],
            ['Can I get a scholarship?',
             'Often, yes — MEXT for Japan, GKS for Korea, and CSC plus provincial and university awards for China. Most have hard deadlines several months before the intake and are far more competitive than the admission itself. We will tell you frankly whether your profile is realistic for a given award.'],
            ['Can I work part-time while studying?',
             'Japan permits up to 28 hours a week once you hold the correct endorsement, and 40 during long holidays. Korea and China have their own limits tied to visa type and semester. The rules change, so we go through the current position for your country before departure rather than publishing a number that dates.'],
            ['Do you help after I arrive?',
             'Yes — accommodation guidance, airport pickup coordination and first-month settlement support, plus the pre-departure briefing for every student regardless of package. You also stay in our alumni group, which is where most of the practical advice actually comes from.'],
        ];

        foreach ($home as $i => [$q, $a]) {
            Faq::updateOrCreate(
                ['scope' => 'home', 'question' => $q],
                ['answer' => $a, 'sort' => $i + 1],
            );
        }

        $japanese = Course::where('slug', 'japanese')->first();

        $courseFaqs = [
            ['I know nothing at all. Can I still join?',
             'Yes — N5 assumes zero Japanese. Month one is the two alphabets, taught from scratch. Roughly four in five of our N5 students have never seen a Japanese character before their first class.'],
            ['How long until I can apply to a language school?',
             'Four months of N5, then the exam. JLPT is held twice a year (July and December), so the exam date usually decides your timeline rather than the course length. NAT-TEST runs more often and is accepted by most schools — we plan around whichever fits your intake.'],
            ['Is the online course really the same?',
             'Same syllabus, same instructor, same mock papers, same certificate. What differs is live interaction: the online course gives you a weekly group doubt session and scheduled one-to-one kaiwa calls, where in class you get that every session. Online access lasts twelve months.'],
            ['What if I miss classes?',
             'Every in-class session is recorded and appears in your online account within 24 hours, included in the fee. If you miss more than four consecutive classes we will move you to the next batch rather than let you fall behind.'],
            ['Do you register me for the JLPT exam?',
             'We handle the paperwork and remind you of the deadline, but the registration fee is paid directly to the exam body and is not part of the course fee. Registration closes months before the exam, and missing it costs you half a year.'],
            ['Can I pay in instalments?',
             'Yes, in two instalments — half at enrolment, half at the midpoint of the course. Ask the counsellor at registration; there is no extra charge for it.'],
        ];

        if ($japanese) {
            foreach ($courseFaqs as $i => [$q, $a]) {
                Faq::updateOrCreate(
                    ['scope' => 'course', 'course_id' => $japanese->id, 'question' => $q],
                    ['answer' => $a, 'sort' => $i + 1],
                );
            }
        }

        $pages = [
            ['mission', 'Our mission',
             'To make studying abroad reachable for Bangladeshi students who have the ability but not the guidance — by teaching the language properly and telling the truth about cost, timeline and odds.'],
            ['vision', 'Our vision',
             'To be the institute Bangladeshi families name first when a student says they want to study in Japan, Korea or China.'],
            ['chairman-message', "Chairman's message",
             "Welcome to Multi Languages Gateway. We founded MLG on a simple conviction: a Bangladeshi student with the ability to study abroad should not be held back by poor guidance, hidden costs or a language barrier nobody helped them cross.\n\nSo we teach the language properly — Japanese, Korean, Chinese and IELTS — and we stay with you through admission, scholarship and visa. One team, start to finish. We publish our fees, we tell you honestly when a plan is not realistic, and we do not take a file we do not believe in."],
            ['methodology', 'Our teaching methodology',
             'Speak from week one. Teach to the exam format. Measure every week. Small batches, real attention.'],
        ];

        foreach ($pages as [$slug, $title, $body]) {
            Page::updateOrCreate(['slug' => $slug], ['title' => $title, 'body' => $body]);
        }
    }
}
