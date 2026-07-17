@extends('layouts.app')

@section('title', 'Тренеры - ReGYM Фитнес клуб')
@section('content')
<style>



.trainers-hero-v2 {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    color: white;
    overflow: hidden;
    padding: 70px 0 25px;
    z-index: 1;
}

.trainers-background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center 40%;
    animation: zoomIn 20s infinite alternate ease-in-out;
    background-attachment: fixed;
}

@keyframes zoomIn {
    0% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1.1);
    }
}

.trainers-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, 
        rgba(0, 0, 0, 0.95) 0%, 
        rgba(29, 31, 43, 0.9) 40%, 
        rgba(29, 31, 43, 0.6) 100%);
    z-index: 2;
}

.trainers-hero-content-v2 {
    position: relative;
    z-index: 3;
    width: 100%;
    animation: fadeIn 1.5s ease-out 0.2s both;
    display: flex;
    align-items: center;
    min-height: calc(70vh - 25px);
    padding-bottom: 100px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.trainers-text-wrapper {
    max-width: 780px;
    width: 100%;
    padding: 5px 20px;
    position: relative;
    z-index: 4;
    box-sizing: border-box;
    text-align: left; 
}

.trainers-logo-title {
    display: flex;
    align-items: center; 
    gap: 12px;
    margin-bottom: 10px;
    animation: slideInLeft 1s ease-out 0.3s both;
    justify-content: flex-start; 
}

.trainers-logo-img-hero {
    width: 65px;
    height: 65px;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.3));
    animation: pulse 2s infinite alternate;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
        filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.3));
    }
    100% {
        transform: scale(1.05);
        filter: drop-shadow(0 6px 12px rgba(255, 215, 0, 0.5));
    }
}

.trainers-logo-text-hero {
    font-size: clamp(32px, 4.5vw, 48px);
    font-weight: 800;
    color: var(--color-white);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    line-height: 1;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.trainers-logo-yellow {
    color: var(--color-yellow);
    text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
}

.trainers-logo-white {
    color: var(--color-white);
}

.trainers-hero-title-v2 {
    font-size: clamp(1.8rem, 3.5vw, 2.4rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 0.6rem;
    position: relative;
    text-align: left; 
}

.trainers-hero-subtitle-main {
    display: block;
    font-size: clamp(1.5rem, 3vw, 2.1rem);
    line-height: 1.1;
    margin-top: 5px;
    background: linear-gradient(90deg, var(--color-white), var(--color-yellow));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: slideInUp 1s ease-out 0.6s both;
    text-align: left; 
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.trainers-hero-subtitle-v2 {
    font-size: clamp(0.95rem, 1.6vw, 1.1rem);
    line-height: 1.5;
    margin-bottom: 1rem;
    opacity: 0.95;
    animation: fadeIn 1s ease-out 0.9s both;
    position: relative;
    padding-left: 15px;
    border-left: 3px solid var(--color-yellow);
    padding-right: 15px;
    text-align: left; 
}

.trainers-hero-subtitle-v2 br {
    display: block;
    margin: 4px 0;
}

.trainers-hero-subtitle-v2 strong {
    display: inline;
}

.trainers-hero-actions {
    display: flex;
    flex-direction: row;
    gap: 15px;
    width: 500px;
    align-items: flex-start;
    animation: fadeIn 1s ease-out 1.2s both;
    margin-bottom: 10px;
    flex-wrap: nowrap;
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
    color: var(--color-black);
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
    flex: 1;
    min-width: 0;
    white-space: nowrap;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: 0.5s;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-outline-light {
    background: transparent;
    color: white;
    border: 2px solid white;
    padding: 10px 22px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    flex: 1;
    min-width: 0;
    white-space: nowrap;
}

.btn-outline-light:hover {
    background: white;
    color: var(--color-black);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
}

@keyframes buttonPulse {
    0% {
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
    }
    50% {
        box-shadow: 0 4px 20px rgba(255, 215, 0, 0.4);
    }
    100% {
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.2);
    }
}

.btn-primary {
    animation: buttonPulse 2s infinite ease-in-out;
}


.trainers-hero-disc-left {
    position: absolute;
    width: 325px;
    height: 325px;
    left: -100px;
    bottom: -40px;
    z-index: 3;
    filter: 
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4))
        opacity(0.9);
    animation: floatDiscLeft 3s infinite ease-in-out;
}

.trainers-hero-disc-right {
    position: absolute;
    width: 250px;
    height: 250px;
    right: 20px;
    top: 20%;
    z-index: 3;
    filter: 
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4))
        opacity(0.9);
    animation: floatDiscRight 3s infinite ease-in-out 0.5s;
}

.trainers-hero-hero {
    height: 550px;
    width: 405px;
    position: absolute;
    right: 110px;
    top: 12%;
    opacity: 0.8;
    animation: floatDiscLeft 10s infinite ease-in-out;
}

@keyframes floatDiscLeft {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-10px) rotate(5deg);
    }
}

@keyframes floatDiscRight {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-10px) rotate(-5deg);
    }
}


.trainers-grid-section {
    padding: 60px 0;
    background: #1d1f2b;
}

.section-title {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: var(--color-white);
    text-align: center;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.section-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.95rem, 1.5vw, 1.1rem);
    color: rgba(255, 255, 255, 0.7);
    text-align: center;
    margin-bottom: 30px;
    margin-top: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}


.trainers-grid-container {
    width: 100%;
    display: flex;
    justify-content: center;
}

.trainers-grid-inner {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.trainers-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    width: 100%;
    padding: 0 15px;
}


.trainer-card-modern {
    background: #404153;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    flex-direction: column;
    height: 540px; 
    min-height: 540px;
    max-height: 540px;
}

.trainer-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(255, 215, 0, 0.15);
    border-color: var(--color-yellow);
}

.trainer-photo-modern-wrapper {
    position: relative;
    width: 100%;
    height: 260px; 
    overflow: hidden;
    flex-shrink: 0;
}

.trainer-photo-modern {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.trainer-card-modern:hover .trainer-photo-modern {
    transform: scale(1.05);
}

.trainer-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 15px;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.95));
    color: white;
    transform: translateY(100%);
    transition: transform 0.3s ease;
    font-size: 0.85rem;
    line-height: 1.4;
}

.trainer-card-modern:hover .trainer-overlay {
    transform: translateY(0);
}

.trainer-info-modern {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.trainer-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
    flex-shrink: 0;
}

.trainer-name-modern {
    font-family: 'Oswald', sans-serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--color-white);
    line-height: 1.2;
    flex: 1;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.trainer-experience-badge {
    background: var(--color-yellow);
    color: var(--color-black);
    padding: 4px 12px;
    border-radius: 20px;
    font-family: 'Oswald', sans-serif;
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    flex-shrink: 0;
    margin-left: 10px;
}

.trainer-specialization-modern {
    color: var(--color-yellow);
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    margin-bottom: 12px;
    font-size: 0.95rem;
    flex-shrink: 0;
}

.trainer-quote-container {
    flex: 1;
    min-height: 0;
    margin-bottom: 15px;
    overflow: hidden;
}

.trainer-quote {
    font-family: 'Inter', sans-serif;
    color: rgba(255, 255, 255, 0.7);
    font-style: italic;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
    border-left: 2px solid rgba(255, 215, 0, 0.3);
    padding-left: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 65px;
}

.trainer-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 15px;
    flex-shrink: 0;
}

.skill-badge {
    background: rgba(255, 215, 0, 0.1);
    color: var(--color-yellow);
    padding: 5px 10px;
    border-radius: 6px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.skill-badge:hover {
    background: rgba(255, 215, 0, 0.2);
    transform: translateY(-2px);
}

.trainer-action-modern {
    display: block;
    text-align: center;
    background: rgba(255, 215, 0, 0.1);
    color: var(--color-yellow);
    padding: 12px;
    border-radius: 8px;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    transition: all 0.3s ease;
    flex-shrink: 0;
    font-size: 0.9rem;
}

.trainer-action-modern:hover {
    background: rgba(255, 215, 0, 0.2);
    color: var(--color-white);
    border-color: var(--color-yellow);
}


.process-section {
    padding: 80px 0;
    background: #20212b;
}

.process-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    counter-reset: step-counter;
}

.process-step {
    padding: 30px;
    background: #404153;
    border-radius: 12px;
    position: relative;
    border: 1px solid rgba(255, 215, 0, 0.1);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.process-step:hover {
    transform: translateY(-5px);
    border-color: var(--color-yellow);
    box-shadow: 0 10px 25px rgba(255, 215, 0, 0.1);
}

.process-step::before {
    counter-increment: step-counter;
    content: counter(step-counter);
    position: absolute;
    top: -15px;
    left: 30px;
    width: 40px;
    height: 40px;
    background: var(--color-yellow);
    color: var(--color-black);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Oswald', sans-serif;
    font-weight: 800;
    font-size: 1.2rem;
}

.process-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.process-icon svg {
    width: 24px;
    height: 24px;
    stroke: var(--color-yellow);
}

.process-step h3 {
    font-family: 'Oswald', sans-serif;
    font-size: 1.3rem;
    color: var(--color-white);
    margin-bottom: 15px;
}

.process-step p {
    font-family: 'Inter', sans-serif;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
}


.trainers-form-section {
    padding: 80px 0;
    background: #2a2c3a;
}

.trainers-form-title {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
    color: var(--color-white);
    text-align: center;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.trainers-form-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.9rem, 1.5vw, 1.1rem);
    color: rgba(255, 255, 255, 0.7);
    text-align: center;
    margin-bottom: 50px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.trainers-form-container {
    max-width: 600px;
    margin: 0 auto;
    background: #404153;
    padding: 40px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.trainer-select-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px;
}

.trainer-select-photo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.trainer-select-info {
    display: flex;
    flex-direction: column;
}

.trainer-select-name {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    color: var(--color-white);
    font-size: 0.9rem;
}

.trainer-select-specialization {
    font-family: 'Inter', sans-serif;
    color: var(--color-yellow);
    font-size: 0.8rem;
}

.form-submit-btn {
    background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
    color: var(--color-black);
    padding: 15px 30px;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.form-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
}


.form-group select.form-control {
    background-color: #51556d !important; 
    color: white !important; 
    border-radius: 6px;
    padding: 12px 15px;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    width: 100%;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23FFD700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    padding-right: 45px;
}

.form-group select.form-control:focus {
    outline: none;
}


.form-group select.form-control option {
    background-color: #2a2c3a !important;
    color: white !important;
    padding: 10px !important;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
}


.form-group select.form-control option:checked {
    background-color: rgba(255, 215, 0, 0.2) !important;
    color: var(--color-yellow) !important;
}


.form-group select.form-control option:hover {
    background-color: rgba(255, 215, 0, 0.1) !important;
}


.form-group input.form-control,
.form-group textarea.form-control {
    background-color: #51556d !important;
    color: white !important;
    border-radius: 6px;
    padding: 12px 15px;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    width: 100%;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.form-group input.form-control:focus,
.form-group textarea.form-control:focus {
    outline: none;
}

.form-group input.form-control::placeholder,
.form-group textarea.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5) !important;
}


@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.8s ease-out both;
}

.delay-1 {
    animation-delay: 0.2s;
}

.delay-2 {
    animation-delay: 0.4s;
}

.delay-3 {
    animation-delay: 0.6s;
}




@media (max-width: 1200px) {
    .trainers-grid-modern {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }
    
    .trainer-card-modern {
        height: 520px; 
        min-height: 520px;
        max-height: 520px;
    }
    
    .trainer-photo-modern-wrapper {
        height: 240px; 
    }
    
    .trainers-hero-hero {
        opacity: 0;
        display: none;
    }
    
    .trainers-hero-content-v2 {
        justify-content: flex-start; 
        text-align: left;
    }
    
    .trainers-text-wrapper {
        text-align: left; 
        max-width: 90%;
        margin: 0;
    }
    
    .trainers-logo-title {
        justify-content: flex-start; 
    }
    
    .trainers-hero-actions {
        justify-content: flex-start; 
        width: 100%;
        max-width: 500px;
    }
    
    .trainers-hero-disc-left {
        left: 5%;
        bottom: 10%;
        width: 250px;
        height: 250px;
    }
    
    .trainers-hero-disc-right {
        right: 5%;
        top: 20%;
        width: 200px;
        height: 200px;
    }
}


@media (max-width: 992px) {
    .trainers-hero-v2 {
        min-height: 55vh;
        padding: 60px 0 20px;
    }
    
    .trainers-hero-content-v2 {
        min-height: calc(55vh - 20px);
        padding-bottom: 60px;
        justify-content: flex-start; 
    }
    
    .trainers-grid-modern {
        grid-template-columns: repeat(2, minmax(280px, 1fr));
        gap: 20px;
    }
    
    .trainer-card-modern {
        height: 500px; 
        min-height: 500px;
        max-height: 500px;
    }
    
    .trainer-photo-modern-wrapper {
        height: 230px; 
    }
    
    .trainer-quote {
        height: 60px;
        -webkit-line-clamp: 2;
    }
    
    .trainers-hero-disc-left {
        width: 200px;
        height: 200px;
        left: 3%;
        bottom: 8%;
    }
    
    .trainers-hero-disc-right {
        width: 160px;
        height: 160px;
        right: 3%;
        top: 15%;
    }
    
    .process-steps {
        grid-template-columns: repeat(2, 1fr);
    }
}


@media (max-width: 768px) {
    .trainers-hero-v2 {
        min-height: 50vh;
        padding: 50px 0 15px;
    }
    
    .trainers-background-image {
        background-attachment: scroll;
        animation: none;
    }
    
    .trainers-hero-content-v2 {
        min-height: calc(50vh - 15px);
        padding-bottom: 40px;
        justify-content: flex-start; 
    }
    
    .trainers-logo-title {
        gap: 8px;
        margin-bottom: 15px;
        justify-content: flex-start; 
    }
    
    .trainers-logo-img-hero {
        width: 50px;
        height: 50px;
    }
    
    .trainers-logo-text-hero {
        font-size: clamp(24px, 3.5vw, 32px);
    }
    
    .trainers-hero-title-v2 {
        font-size: clamp(1.5rem, 3vw, 1.8rem);
        text-align: left; 
    }
    
    .trainers-hero-subtitle-main {
        font-size: clamp(1.3rem, 2.5vw, 1.6rem);
        text-align: left; 
    }
    
    .trainers-hero-subtitle-v2 {
        font-size: 0.9rem;
        line-height: 1.4;
        text-align: left; 
        padding-left: 10px;
        border-left-width: 2px;
        margin: 0 0 20px 0; 
        max-width: 100%;
    }
    
    .trainers-hero-subtitle-v2 br {
        display: none;
    }
    
    .trainers-hero-actions {
        flex-direction: column;
        gap: 12px;
        width: 100%;
        max-width: 300px;
        margin: 0 0 20px 0; 
        align-items: flex-start; 
    }
    
    .btn-primary,
    .btn-outline-light {
        width: 100%;
        max-width: 100%;
        padding: 12px 20px;
    }
    
    
    .trainers-grid-section {
        padding: 40px 0;
    }
    
    .trainers-grid-modern {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
        gap: 20px;
    }
    
    .trainer-card-modern {
        height: auto;
        min-height: auto;
        max-height: none;
        height: 480px; 
    }
    
    .trainer-photo-modern-wrapper {
        height: 220px; 
    }
    
    .trainer-info-modern {
        padding: 15px;
    }
    
    .trainer-name-modern {
        font-size: 1.2rem;
    }
    
    .trainer-quote {
        height: 55px;
        font-size: 0.85rem;
        padding-left: 10px;
    }
    
    .trainer-skills {
        margin-bottom: 12px;
    }
    
    .skill-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }
    
    .trainer-action-modern {
        padding: 10px;
        font-size: 0.85rem;
    }
    
    .trainers-hero-disc-left {
        width: 150px;
        height: 150px;
        left: 2%;
        bottom: 5%;
    }
    
    .trainers-hero-disc-right {
        width: 120px;
        height: 120px;
        right: 2%;
        top: 10%;
    }
    
    .process-section {
        padding: 50px 0;
    }
    
    .process-steps {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .process-step {
        padding: 25px;
    }
    
    .process-step::before {
        left: 20px;
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
    
    .trainers-form-section {
        padding: 50px 0;
    }
    
    .trainers-form-container {
        padding: 25px;
        margin: 0 15px;
    }
    
    .form-submit-btn {
        padding: 12px 20px;
        font-size: 0.9rem;
    }
}


@media (max-width: 576px) {
    .trainers-hero-v2 {
        min-height: 45vh;
        padding: 40px 0 10px;
    }
    
    .trainers-hero-content-v2 {
        min-height: calc(45vh - 10px);
        padding-bottom: 30px;
        justify-content: flex-start; 
    }
    
    .trainers-text-wrapper {
        padding: 0 15px;
        text-align: left; 
    }
    
    .trainers-logo-img-hero {
        width: 40px;
        height: 40px;
    }
    
    .trainers-logo-text-hero {
        font-size: 20px;
    }
    
    .trainers-hero-title-v2 {
        font-size: 1.3rem;
        text-align: left; 
    }
    
    .trainers-hero-subtitle-main {
        font-size: 1.1rem;
        text-align: left; 
    }
    
    .trainers-hero-subtitle-v2 {
        font-size: 0.8rem;
        margin-bottom: 15px;
        text-align: left; 
    }
    
    .trainers-hero-actions {
        gap: 10px;
        max-width: 280px;
        align-items: flex-start; 
    }
    
    
    .trainers-grid-modern {
        max-width: 320px;
        gap: 15px;
    }
    
    .trainer-card-modern {
        height: 460px; 
    }
    
    .trainer-photo-modern-wrapper {
        height: 200px; 
    }
    
    .trainer-header-modern {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .trainer-experience-badge {
        margin-left: 0;
        align-self: flex-start;
    }
    
    .trainer-name-modern {
        white-space: normal;
        font-size: 1.1rem;
    }
    
    .trainer-quote {
        height: 50px;
        -webkit-line-clamp: 2;
        font-size: 0.8rem;
    }
    
    .trainer-action-modern {
        font-size: 0.8rem;
        padding: 8px;
    }
    
    .trainers-hero-disc-left {
        width: 120px;
        height: 120px;
        left: 1%;
        bottom: 3%;
    }
    
    .trainers-hero-disc-right {
        width: 100px;
        height: 100px;
        right: 1%;
        top: 8%;
    }
    
    .process-step {
        padding: 20px;
    }
    
    .process-step::before {
        left: 15px;
        width: 30px;
        height: 30px;
        font-size: 0.9rem;
    }
    
    .process-icon {
        width: 40px;
        height: 40px;
        margin-bottom: 15px;
    }
    
    .process-icon svg {
        width: 20px;
        height: 20px;
    }
    
    .process-step h3 {
        font-size: 1.1rem;
    }
    
    .process-step p {
        font-size: 0.9rem;
    }
    
    .trainers-form-container {
        padding: 20px;
    }
}


@media (max-width: 360px) {
    .trainers-hero-v2 {
        min-height: 40vh;
    }
    
    .trainers-grid-modern {
        max-width: 290px;
    }
    
    .trainer-card-modern {
        height: 440px; 
    }
    
    .trainer-photo-modern-wrapper {
        height: 180px; 
    }
    
    .trainer-info-modern {
        padding: 12px;
    }
    
    .trainer-quote {
        height: 45px;
        font-size: 0.75rem;
    }
    
    .skill-badge {
        font-size: 0.65rem;
        padding: 3px 6px;
    }
    
    .trainers-form-container {
        padding: 15px;
    }
}


@media (max-height: 600px) and (orientation: landscape) {
    .trainers-hero-v2 {
        min-height: 70vh;
        padding: 30px 0 10px;
    }
    
    .trainers-hero-content-v2 {
        min-height: calc(70vh - 30px);
        padding-bottom: 20px;
    }
    
    .trainers-hero-title-v2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    
    .trainers-hero-subtitle-v2 {
        font-size: 0.8rem;
        margin-bottom: 15px;
    }
    
    .trainers-hero-actions {
        flex-direction: row;
        gap: 10px;
        max-width: 100%;
    }
    
    .btn-primary,
    .btn-outline-light {
        padding: 8px 15px;
        font-size: 0.85rem;
    }
    
    .trainers-grid-modern {
        grid-template-columns: repeat(2, 1fr);
        max-width: 100%;
    }
    
    .trainer-card-modern {
        height: 500px; 
    }
    
    .trainer-photo-modern-wrapper {
        height: 220px; 
    }
}
</style>

    
    <section class="trainers-hero-v2">
        <div class="trainers-background-image" style="background-image: url('{{ asset('storage/test2.jpg') }}');"></div>
        <div class="trainers-hero-overlay"></div>

        <div class="container trainers-hero-content-v2">
            <div class="trainers-text-wrapper">
                <div class="trainers-logo-title">
                    <img src="/storage/ReGymSymbol.png" alt="ReGYM Logo" class="trainers-logo-img-hero">
                    <span class="trainers-logo-text-hero">
                        <span class="trainers-logo-yellow">Re</span><span class="trainers-logo-white">GYM</span>
                    </span>
                </div>
                
                <h1 class="trainers-hero-title-v2 fade-in">
                    <span class="trainers-hero-subtitle-main">Твои чемпионы</span>
                </h1>
                    
                <p class="trainers-hero-subtitle-v2 fade-in">
                    <strong>Команда профессионалов, которая знает путь к победе.</strong><br>
                    Только у нас: тренеры-чемпионы с соревновательным опытом, индивидуальный подход и доказанная эффективность методик.
                </p>
                
                <div class="trainers-hero-actions fade-in delay-2">
                    <a href="#trainers-grid" class="btn btn-primary">
                        Выбрать тренера
                    </a>
                    <a href="#process" class="btn btn-outline-light">
                        Как это работает
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <section class="trainers-grid-section" id="trainers-grid">
        <div class="container">
            <h2 class="section-title fade-in-up">Наша <span style="color: var(--color-yellow);">команда</span></h2>
            <p class="section-subtitle fade-in-up delay-1">Профессионалы, которые помогут достичь любых целей</p>
            
            <div class="trainers-grid-container">
                <div class="trainers-grid-inner">
                    <div class="trainers-grid-modern">
                        @foreach($trainers as $trainer)
                        <div class="trainer-card-modern fade-in-up">
                            
                            <div class="trainer-photo-modern-wrapper">
                                @if($trainer->photo)
                                <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}" class="trainer-photo-modern">
                                @else
                                <div style="width: 100%; height: 100%; background: var(--color-gray); display: flex; align-items: center; justify-content: center;">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--color-yellow)" stroke-width="1">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                @endif
                                
                                
                                <div class="trainer-overlay">
                                    <p class="trainer-overlay-text">
                                        {{ $trainer->description ?? 'Индивидуальный подход к каждому клиенту. Поможет достичь поставленных целей.' }}
                                    </p>
                                </div>
                            </div>
                            
                            
                            <div class="trainer-info-modern">
                                <div class="trainer-header-modern">
                                    <h3 class="trainer-name-modern">{{ $trainer->name }}</h3>
                                    <span class="trainer-experience-badge">{{ $trainer->experience_years }} лет</span>
                                </div>
                                
                                <p class="trainer-specialization-modern">{{ $trainer->specialization }}</p>
                                
                                <div class="trainer-quote-container">
                                    <p class="trainer-quote">
                                        "{{ $trainer->quote ?? 'Победит не тот, кто сильнее, а тот, кто готов идти до конца' }}"
                                    </p>
                                </div>
                                
                                
                                @php
                                    $sportsArray = is_array($trainer->sports) ? $trainer->sports : [];
                                    if (is_string($trainer->sports) && !empty($trainer->sports)) {
                                        $decoded = json_decode($trainer->sports, true);
                                        $sportsArray = is_array($decoded) ? $decoded : [];
                                    }
                                @endphp
                                
                                @if(!empty($sportsArray))
                                <div class="trainer-skills">
                                    @foreach(array_slice($sportsArray, 0, 4) as $sport)
                                    <span class="skill-badge">{{ $sport }}</span>
                                    @endforeach
                                </div>
                                @endif
                                
                                
                                <a href="{{ route('trainer.show', $trainer->id) }}" class="trainer-action-modern">
                                    Профиль тренера
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="process-section" id="process">
        <div class="container">
            <h2 class="section-title fade-in-up">Как мы <span style="color: var(--color-yellow);">работаем</span></h2>
            <p class="section-subtitle fade-in-up delay-1">Простой путь от цели к результату</p>
            
            <div class="process-steps">
                <div class="process-step fade-in-up">
                    <div class="process-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                    <h3>Анализ и цели</h3>
                    <p>Изучаем ваши физические данные, цели, образ жизни и медицинские показания</p>
                </div>
                
                <div class="process-step fade-in-up delay-1">
                    <div class="process-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <h3>План тренировок</h3>
                    <p>Создаем индивидуальную программу с учетом всех факторов и ваших предпочтений</p>
                </div>
                
                <div class="process-step fade-in-up delay-2">
                    <div class="process-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                        </svg>
                    </div>
                    <h3>Тренировки с тренером</h3>
                    <p>Проводим занятия с полным контролем техники и безопасностью выполнения</p>
                </div>
                
                <div class="process-step fade-in-up delay-3">
                    <div class="process-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3>Корректировка и результат</h3>
                    <p>Регулярно анализируем прогресс и вносим изменения в программу для максимального эффекта</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="trainers-form-section" id="request">
        <div class="container">
            <h2 class="trainers-form-title fade-in-up">Выбрать <span style="color: var(--color-yellow);">тренера</span></h2>
            <p class="trainers-form-subtitle fade-in-up delay-1">
                Оставьте заявку и мы подберем тренера, который идеально подойдет под ваши цели
            </p>
            
            <div class="trainers-form-container fade-in-up delay-2">
                <form id="trainersRequestForm">
                    @csrf
                    <input type="hidden" name="request_type" value="trainer_consultation">
                    
                    <div class="form-group">
                        <select name="trainer_id" class="form-control">
                            <option value="">Выберите тренера (необязательно)</option>
                            @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">
                                {{ $trainer->name }} - {{ $trainer->specialization }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="full_name" class="form-control" placeholder="ФИО" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Телефон" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email (необязательно)">
                    </div>
                    
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="4" placeholder="Ваши цели и пожелания (необязательно)"></textarea>
                    </div>
                    
                    <button type="submit" class="form-submit-btn">
                        Отправить заявку
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trainersRequestForm = document.getElementById('trainersRequestForm');
            if (trainersRequestForm) {
                trainersRequestForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    
                    submitBtn.innerHTML = '<span>Отправка...</span>';
                    submitBtn.disabled = true;
                    
                    try {
                        const response = await fetch("{{ route('request.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            const alertDiv = document.createElement('div');
                            alertDiv.style.cssText = `
                                position: fixed;
                                top: 20px;
                                right: 20px;
                                background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
                                color: var(--color-black);
                                padding: 20px;
                                border-radius: 8px;
                                z-index: 10000;
                                animation: fadeIn 0.3s ease-out;
                                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                                font-family: 'Inter', sans-serif;
                                font-weight: 600;
                                max-width: 300px;
                            `;
                            alertDiv.innerHTML = `
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    <span>${data.message}</span>
                                </div>
                            `;
                            document.body.appendChild(alertDiv);
                            
                            setTimeout(() => {
                                alertDiv.style.animation = 'fadeOut 0.3s ease-out';
                                setTimeout(() => alertDiv.remove(), 300);
                            }, 5000);
                            
                            setTimeout(() => this.reset(), 1000);
                        } else {
                            alert('Ошибка при отправке заявки');
                        }
                    } catch (error) {
                        alert('Ошибка сети');
                    } finally {
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }
            
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.trainer-card-modern, .process-step, .trainers-form-container').forEach((el, index) => {
                observer.observe(el);
            });
        });
    </script>
@endsection