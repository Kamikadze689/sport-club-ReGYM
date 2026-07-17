@extends('layouts.app')

@section('title', $trainer->name . ' - Тренер ReGYM')
@section('content')
<style>


:root {
    --color-dark: #1d1f2b;
    --color-gray: #2a2c3a;
    --color-light-gray: #404153;
    --color-yellow: #FFD700;
    --color-yellow-dark: #e6c200;
    --color-white: #ffffff;
    --color-text: #e0e0e0;
    --color-text-light: rgba(255, 255, 255, 0.7);
    --color-border: rgba(255, 215, 0, 0.2);
    --shadow-glow: 0 0 30px rgba(255, 215, 0, 0.3);
    --shadow-dark: 0 20px 40px rgba(0, 0, 0, 0.5);
    --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}


.trainer-hero-premium {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    color: white;
    overflow: hidden;
    padding: 100px 0 50px;
    background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-gray) 100%);
    z-index: 1;
}

.trainer-hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.15;
    z-index: 1;
}

.trainer-hero-overlay-premium {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, 
        rgba(29, 31, 43, 0.95) 0%,
        rgba(29, 31, 43, 0.85) 50%,
        rgba(29, 31, 43, 0.7) 100%);
    z-index: 2;
}

.trainer-hero-content-premium {
    position: relative;
    z-index: 3;
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

.trainer-hero-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 60px;
    align-items: center;
}


.trainer-photo-section {
    position: relative;
}

.trainer-photo-premium-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-dark);
    transform-style: preserve-3d;
    perspective: 1000px;
}

.trainer-photo-premium {
    width: 100%;
    height: 500px;
    object-fit: cover;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.trainer-photo-premium-wrapper:hover .trainer-photo-premium {
    transform: scale(1.05);
}

.trainer-photo-premium-wrapper::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    background: linear-gradient(45deg, 
        transparent 0%,
        var(--color-yellow) 50%,
        transparent 100%);
    border-radius: 25px;
    opacity: 0.3;
    z-index: -1;
    animation: borderGlow 3s infinite alternate;
}

@keyframes borderGlow {
    0% {
        opacity: 0.2;
        transform: scale(1);
    }
    100% {
        opacity: 0.4;
        transform: scale(1.02);
    }
}


.trainer-experience-badge-premium {
    position: absolute;
    top: 30px;
    right: 30px;
    background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
    color: var(--color-dark);
    padding: 12px 24px;
    border-radius: 50px;
    font-family: 'Oswald', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
    z-index: 2;
    transform: rotate(5deg);
    animation: badgeFloat 3s infinite ease-in-out;
}

@keyframes badgeFloat {
    0%, 100% {
        transform: rotate(5deg) translateY(0);
    }
    50% {
        transform: rotate(5deg) translateY(-10px);
    }
}


.trainer-info-section {
    padding-left: 20px;
}


.trainer-logo-title-premium {
    display: none; 
}

.trainer-name-premium {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(2rem, 4vw, 3rem); 
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 15px; 
    color: var(--color-white);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.trainer-specialization-premium {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1rem, 1.8vw, 1.3rem); 
    color: var(--color-yellow);
    font-weight: 600;
    margin: 25px 0 35px; 
    padding: 20px 0 20px 25px; 
    border-left: 4px solid var(--color-yellow);
    line-height: 1.5;
    position: relative;
    max-width: 600px; 
}


.trainer-specialization-premium::before {
    content: '';
    position: absolute;
    left: -4px;
    top: 0;
    height: 100%;
    width: 8px;
    background: linear-gradient(180deg, 
        transparent 0%,
        var(--color-yellow) 50%,
        transparent 100%);
    opacity: 0.3;
    border-radius: 4px;
}


.trainer-skills-premium {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 35px;
}

.skill-badge-premium {
    background: rgba(255, 215, 0, 0.1);
    color: var(--color-yellow);
    padding: 12px 24px;
    border-radius: 50px;
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 2px solid rgba(255, 215, 0, 0.3);
    transition: var(--transition);
    backdrop-filter: blur(10px);
}

.skill-badge-premium:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: var(--color-yellow);
    transform: translateY(-3px);
    box-shadow: var(--shadow-glow);
}


.trainer-quote-premium {
    font-family: 'Inter', sans-serif;
    font-style: italic;
    font-size: clamp(1rem, 1.8vw, 1.2rem); 
    line-height: 1.6;
    color: var(--color-text-light);
    margin: 30px 0;
    padding: 25px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    border-left: 5px solid var(--color-yellow);
    position: relative;
    overflow: hidden;
}

.trainer-quote-premium::before {
    content: '"';
    position: absolute;
    top: -20px;
    left: 15px;
    font-size: 80px;
    color: var(--color-yellow);
    opacity: 0.1;
    font-family: serif;
    line-height: 1;
}


.trainer-actions-premium {
    display: flex;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.btn-premium {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 16px 32px;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 8px;
    text-decoration: none;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
    min-width: 200px;
}

.btn-primary-premium {
    background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
    color: var(--color-dark);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
}

.btn-outline-premium {
    background: transparent;
    color: var(--color-white);
    border: 2px solid var(--color-white);
}

.btn-outline-premium:hover {
    background: var(--color-white);
    color: var(--color-dark);
}

.btn-premium:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
}

.btn-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.2), 
        transparent);
    transition: 0.5s;
}

.btn-premium:hover::before {
    left: 100%;
}


.trainer-about-section {
    padding: 80px 0;
    background: var(--color-gray);
}

.section-title-premium {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(2rem, 3.5vw, 3rem); 
    font-weight: 800;
    color: var(--color-white);
    text-align: center;
    margin-bottom: 50px;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
}

.section-title-premium::after {
    content: '';
    display: block;
    width: 100px;
    height: 5px;
    background: var(--color-yellow);
    margin: 20px auto 0;
    border-radius: 3px;
}

.section-title-premium span {
    color: var(--color-yellow);
}

.trainer-about-card-premium {
    background: var(--color-light-gray);
    border-radius: 20px;
    padding: 50px;
    position: relative;
    overflow: hidden;
    border: 1px solid var(--color-border);
    box-shadow: var(--shadow-dark);
    backdrop-filter: blur(10px);
}

.trainer-about-card-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, 
        var(--color-yellow), 
        transparent);
    border-radius: 20px 20px 0 0;
}

.trainer-description-premium {
    font-family: 'Inter', sans-serif;
    font-size: 1.05rem; 
    line-height: 1.8;
    color: var(--color-text);
    margin-bottom: 40px;
    white-space: pre-line;
}

.trainer-description-premium p {
    margin-bottom: 20px;
}


.trainer-achievements {
    margin-top: 40px;
    padding-top: 40px;
    border-top: 1px solid var(--color-border);
}

.achievements-title {
    font-family: 'Oswald', sans-serif;
    font-size: 1.4rem; 
    color: var(--color-white);
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700; 
}

.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.achievement-card {
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: 10px;
    border: 1px solid rgba(255, 215, 0, 0.1);
    transition: var(--transition);
}

.achievement-card:hover {
    border-color: var(--color-yellow);
    transform: translateY(-5px);
    background: rgba(255, 215, 0, 0.05);
}

.achievement-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    color: var(--color-yellow);
}

.achievement-card h4 {
    font-family: 'Inter', sans-serif;
    font-size: 1.05rem; 
    color: var(--color-white);
    margin-bottom: 8px;
}

.achievement-card p {
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    color: var(--color-text-light);
    line-height: 1.5;
}


.trainer-specialization-section {
    padding: 80px 0;
    background: var(--color-dark);
    position: relative;
    overflow: hidden;
}

.trainer-specialization-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, 
        transparent, 
        var(--color-yellow), 
        transparent);
}

.specialization-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.specialization-card {
    background: var(--color-light-gray);
    border-radius: 15px;
    padding: 35px 30px;
    text-align: center;
    transition: var(--transition);
    border: 1px solid var(--color-border);
    position: relative;
    overflow: hidden;
}

.specialization-card:hover {
    transform: translateY(-10px);
    border-color: var(--color-yellow);
    box-shadow: var(--shadow-glow);
}

.specialization-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--color-yellow);
    transform: scaleX(0);
    transition: transform 0.3s;
}

.specialization-card:hover::before {
    transform: scaleX(1);
}

.specialization-icon {
    width: 70px;
    height: 70px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: var(--color-yellow);
    font-size: 28px;
    transition: var(--transition);
}

.specialization-card:hover .specialization-icon {
    background: rgba(255, 215, 0, 0.2);
    transform: scale(1.1) rotate(5deg);
}

.specialization-card h3 {
    font-family: 'Oswald', sans-serif;
    font-size: 1.3rem; 
    color: var(--color-white);
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.specialization-card p {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: var(--color-text-light);
    line-height: 1.6;
}


.trainer-form-section {
    padding: 80px 0;
    background: var(--color-gray);
}

.form-container-premium {
    max-width: 700px;
    margin: 0 auto;
    background: var(--color-light-gray);
    padding: 50px;
    border-radius: 20px;
    border: 1px solid var(--color-border);
    box-shadow: var(--shadow-dark);
    position: relative;
    overflow: hidden;
}

.form-container-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, 
        var(--color-yellow), 
        transparent);
}

.form-title-premium {
    font-family: 'Oswald', sans-serif;
    font-size: clamp(1.6rem, 2.8vw, 2.2rem); 
    font-weight: 800;
    color: var(--color-white);
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-align: center;
}

.form-title-premium span {
    color: var(--color-yellow);
}

.form-group-premium {
    margin-bottom: 25px;
}

.form-group-premium label {
    display: block;
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    color: var(--color-white);
    margin-bottom: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control-premium {
    width: 100%;
    padding: 16px 20px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    color: var(--color-white);
    transition: var(--transition);
}

.form-control-premium:focus {
    outline: none;
    border-color: var(--color-yellow);
    background: rgba(255, 255, 255, 0.12);
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
}

.form-control-premium::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

textarea.form-control-premium {
    min-height: 150px;
    resize: vertical;
}

.form-submit-btn-premium {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
    color: var(--color-dark);
    border: none;
    border-radius: 8px;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    margin-top: 20px;
}

.form-submit-btn-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
}

.form-submit-btn-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.2), 
        transparent);
    transition: 0.5s;
}

.form-submit-btn-premium:hover::before {
    left: 100%;
}


.other-trainers-section {
    padding: 80px 0;
    background: var(--color-dark);
}

.other-trainers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.other-trainer-card {
    background: var(--color-light-gray);
    border-radius: 15px;
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid var(--color-border);
}

.other-trainer-card:hover {
    transform: translateY(-10px);
    border-color: var(--color-yellow);
    box-shadow: var(--shadow-glow);
}

.other-trainer-photo {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.other-trainer-card:hover .other-trainer-photo {
    transform: scale(1.1);
}

.other-trainer-info {
    padding: 25px;
}

.other-trainer-name {
    font-family: 'Oswald', sans-serif;
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--color-white);
    margin-bottom: 8px;
}

.other-trainer-specialization {
    font-family: 'Inter', sans-serif;
    color: var(--color-yellow);
    font-weight: 500;
    margin-bottom: 15px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.other-trainer-btn {
    display: block;
    text-align: center;
    padding: 12px;
    background: rgba(255, 215, 0, 0.1);
    color: var(--color-yellow);
    border: 1px solid rgba(255, 215, 0, 0.3);
    border-radius: 8px;
    text-decoration: none;
    font-family: 'Oswald', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: var(--transition);
}

.other-trainer-btn:hover {
    background: rgba(255, 215, 0, 0.2);
    color: var(--color-white);
    border-color: var(--color-yellow);
}

.all-trainers-btn {
    text-align: center;
    margin-top: 50px;
}




@media (max-width: 1200px) {
    .trainer-hero-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .trainer-photo-premium {
        height: 400px;
    }
    
    .trainer-info-section {
        padding-left: 0;
        text-align: center;
    }
    
    .trainer-name-premium {
        text-align: center;
    }
    
    .trainer-specialization-premium {
        text-align: center;
        border-left: none;
        border-bottom: 4px solid var(--color-yellow);
        padding-left: 0;
        padding-bottom: 20px;
        margin: 25px auto 35px;
        max-width: 500px;
    }
    
    .trainer-specialization-premium::before {
        display: none; 
    }
    
    .trainer-skills-premium {
        justify-content: center;
    }
    
    .trainer-actions-premium {
        justify-content: center;
    }
    
    .trainer-about-card-premium {
        padding: 40px;
    }
    
    .form-container-premium {
        padding: 40px;
    }
}


@media (max-width: 992px) {
    .trainer-hero-premium {
        min-height: 60vh;
        padding: 80px 0 40px;
    }
    
    .trainer-photo-premium {
        height: 350px;
    }
    
    .trainer-name-premium {
        font-size: clamp(1.8rem, 3.5vw, 2.5rem);
    }
    
    .trainer-experience-badge-premium {
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        font-size: 1.1rem;
    }
    
    .trainer-about-section,
    .trainer-specialization-section,
    .trainer-form-section,
    .other-trainers-section {
        padding: 60px 0;
    }
    
    .section-title-premium {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        margin-bottom: 40px;
    }
    
    .achievements-title {
        font-size: 1.3rem;
    }
    
    .specialization-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .other-trainers-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}


@media (max-width: 768px) {
    .trainer-hero-premium {
        min-height: auto;
        padding: 60px 0 30px;
    }
    
    .trainer-hero-content-premium {
        padding: 0 20px;
    }
    
    .trainer-photo-premium {
        height: 300px;
    }
    
    .trainer-experience-badge-premium {
        top: 15px;
        right: 15px;
        padding: 8px 16px;
        font-size: 1rem;
    }
    
    .trainer-name-premium {
        font-size: clamp(1.6rem, 3vw, 2rem);
    }
    
    .trainer-specialization-premium {
        font-size: 1rem;
        margin: 20px 0 30px;
        padding: 15px 0 15px 20px;
    }
    
    .skill-badge-premium {
        padding: 10px 20px;
        font-size: 0.85rem;
    }
    
    .trainer-quote-premium {
        padding: 20px;
        font-size: 0.95rem;
    }
    
    .btn-premium {
        padding: 14px 28px;
        min-width: 170px;
        font-size: 0.9rem;
    }
    
    .trainer-about-card-premium {
        padding: 30px 25px;
    }
    
    .trainer-description-premium {
        font-size: 1rem;
    }
    
    .achievements-title {
        font-size: 1.2rem;
    }
    
    .specialization-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .specialization-card {
        padding: 30px 25px;
    }
    
    .form-container-premium {
        padding: 30px 25px;
    }
    
    .form-title-premium {
        font-size: clamp(1.4rem, 2.5vw, 1.8rem);
    }
    
    .other-trainers-grid {
        grid-template-columns: 1fr;
        max-width: 350px;
        margin: 30px auto 0;
    }
    
    .other-trainer-photo {
        height: 180px;
    }
    
    .achievements-grid {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 576px) {
    .trainer-photo-premium {
        height: 250px;
    }
    
    .trainer-name-premium {
        font-size: 1.4rem;
    }
    
    .trainer-specialization-premium {
        font-size: 0.95rem;
        padding: 12px 0 12px 15px;
        margin: 15px 0 25px;
    }
    
    .skill-badge-premium {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
    
    .trainer-actions-premium {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-premium {
        width: 100%;
        min-width: auto;
    }
    
    .trainer-about-card-premium {
        padding: 25px 20px;
    }
    
    .trainer-description-premium {
        font-size: 0.95rem;
    }
    
    .section-title-premium {
        font-size: 1.6rem;
    }
    
    .achievements-title {
        font-size: 1.1rem;
    }
    
    .specialization-card {
        padding: 25px 20px;
    }
    
    .specialization-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
    
    .specialization-card h3 {
        font-size: 1.1rem;
    }
    
    .form-container-premium {
        padding: 25px 20px;
    }
    
    .form-control-premium {
        padding: 14px 16px;
    }
    
    .form-submit-btn-premium {
        padding: 16px;
        font-size: 1rem;
    }
    
    .other-trainers-grid {
        max-width: 100%;
    }
}


@media (max-width: 360px) {
    .trainer-photo-premium {
        height: 220px;
    }
    
    .trainer-name-premium {
        font-size: 1.3rem;
    }
    
    .trainer-specialization-premium {
        font-size: 0.9rem;
        padding: 10px 0 10px 12px;
    }
    
    .trainer-quote-premium {
        font-size: 0.85rem;
        padding: 15px;
    }
    
    .skill-badge-premium {
        padding: 6px 12px;
        font-size: 0.75rem;
    }
    
    .section-title-premium {
        font-size: 1.4rem;
    }
    
    .achievements-title {
        font-size: 1rem;
    }
}


@media (max-height: 600px) and (orientation: landscape) {
    .trainer-hero-premium {
        min-height: auto;
        padding: 40px 0 20px;
    }
    
    .trainer-photo-premium {
        height: 250px;
    }
    
    .trainer-hero-grid {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .trainer-info-section {
        padding-left: 20px;
        text-align: left;
    }
    
    .trainer-name-premium {
        text-align: left;
    }
    
    .trainer-specialization-premium {
        text-align: left;
        border-left: 4px solid var(--color-yellow);
        border-bottom: none;
        padding-left: 20px;
        padding-bottom: 0;
        margin: 20px 0 30px;
    }
    
    .trainer-specialization-premium::before {
        display: block; 
    }
    
    .trainer-skills-premium {
        justify-content: flex-start;
    }
    
    .trainer-actions-premium {
        justify-content: flex-start;
    }
}



@php
    $hasSpecialization = false;
    if (!empty($trainer->sports)) {
        if (is_string($trainer->sports)) {
            $decoded = json_decode($trainer->sports, true);
            $sportsArray = is_array($decoded) ? $decoded : [];
        } else {
            $sportsArray = is_array($trainer->sports) ? $trainer->sports : [];
        }
        $hasSpecialization = !empty($sportsArray);
    }
@endphp


.specialization-section-container {
    display: {{ $hasSpecialization ? 'block' : 'none' }};
}
</style>

    
    <section class="trainer-hero-premium">
        <div class="trainer-hero-background" style="background-image: url('{{ asset('storage/test2.jpg') }}');"></div>
        <div class="trainer-hero-overlay-premium"></div>
        
        <div class="container trainer-hero-content-premium">
            <div class="trainer-hero-grid">
                
                <div class="trainer-photo-section">
                    <div class="trainer-photo-premium-wrapper">
                        @if($trainer->photo)
                            <img src="{{ asset('storage/' . $trainer->photo) }}" 
                                 alt="{{ $trainer->name }}" 
                                 class="trainer-photo-premium" 
                                 loading="lazy">
                        @else
                            <div class="trainer-photo-premium" 
                                 style="background: var(--color-light-gray); display: flex; align-items: center; justify-content: center;">
                                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" 
                                     stroke="var(--color-yellow)" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        @endif
                        <div class="trainer-experience-badge-premium">
                            {{ $trainer->experience_years }} лет
                        </div>
                    </div>
                </div>
                
                
                <div class="trainer-info-section">
                    
                    
                    <h1 class="trainer-name-premium">{{ $trainer->name }}</h1>
                    
                    <p class="trainer-specialization-premium">
                        {{ $trainer->specialization }}
                    </p>
                    
                    
                    @php
                        $sportsArray = is_array($trainer->sports) ? $trainer->sports : [];
                        if (is_string($trainer->sports) && !empty($trainer->sports)) {
                            $decoded = json_decode($trainer->sports, true);
                            $sportsArray = is_array($decoded) ? $decoded : [];
                        }
                    @endphp
                    
                    @if(!empty($sportsArray))
                    <div class="trainer-skills-premium">
                        @foreach($sportsArray as $sport)
                        <span class="skill-badge-premium">{{ $sport }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    
                    @if($trainer->quote)
                    <div class="trainer-quote-premium">
                        "{{ $trainer->quote }}"
                    </div>
                    @endif
                    
                    
                    <div class="trainer-actions-premium">
                        <a href="#request-form" class="btn-premium btn-primary-premium">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" 
                                 stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            Записаться на тренировку
                        </a>
                        <a href="{{ route('trainers') }}" class="btn-premium btn-outline-premium">
                            Все тренеры
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="trainer-about-section">
        <div class="container">
            <h2 class="section-title-premium">О <span>тренере</span></h2>
            
            <div class="trainer-about-card-premium">
                @if($trainer->description)
                <div class="trainer-description-premium">
                    {!! nl2br(e($trainer->description)) !!}
                </div>
                @else
                <div class="trainer-description-premium">
                    <p>Профессиональный тренер с {{ $trainer->experience_years }}-летним опытом работы. 
                    Специализируется на {{ $trainer->specialization }}. Помогает клиентам достигать 
                    поставленных целей через индивидуальный подход и эффективные методики тренировок.</p>
                    
                    <p>Обладает глубокими знаниями в области спортивной физиологии и нутрициологии. 
                    Разрабатывает индивидуальные программы тренировок с учетом особенностей каждого клиента, 
                    его целей и физических возможностей.</p>
                </div>
                @endif
                
                
                <div class="trainer-achievements">
                    <h3 class="achievements-title">Профессиональные достижения</h3>
                    <div class="achievements-grid">
                        <div class="achievement-card">
                            <div class="achievement-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                     stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="7"></circle>
                                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                </svg>
                            </div>
                            <h4>Опыт работы</h4>
                            <p>{{ $trainer->experience_years }}+ лет успешной тренерской практики</p>
                        </div>
                        
                        <div class="achievement-card">
                            <div class="achievement-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                     stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h4>Клиенты</h4>
                            <p>Помог 100+ клиентам достичь поставленных целей</p>
                        </div>
                        
                        <div class="achievement-card">
                            <div class="achievement-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                     stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <h4>Результаты</h4>
                            <p>Доказанная эффективность тренировочных методик</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <div class="specialization-section-container">
        <section class="trainer-specialization-section">
            <div class="container">
                <h2 class="section-title-premium">Специализация <span>тренера</span></h2>
                
                <div class="specialization-grid">
                    @if(!empty($sportsArray))
                        @foreach($sportsArray as $sport)
                        <div class="specialization-card">
                            <div class="specialization-icon">
                                @switch(strtolower($sport))
                                    @case('бокс')
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" 
                                         stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <circle cx="15.5" cy="8.5" r="1.5"></circle>
                                        <path d="M21 15l-5 3-5-3"></path>
                                    </svg>
                                    @break
                                    
                                    @case('армрестлинг')
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" 
                                         stroke="currentColor" stroke-width="2">
                                        <path d="M17 17l5-5-5-5"></path>
                                        <path d="M7 7l-5 5 5 5"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    @break
                                    
                                    @case('фитнес')
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" 
                                         stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="5" r="3"></circle>
                                        <path d="M12 22V8"></path>
                                        <path d="M5 12H2a10 10 0 0 0 20 0h-3"></path>
                                    </svg>
                                    @break
                                    
                                    @case('пауэрлифтинг')
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" 
                                         stroke="currentColor" stroke-width="2">
                                        <path d="M6 16.326A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 .5 8.973"></path>
                                        <path d="M14 12h-4"></path>
                                        <path d="M16 5l-3 3 2 7 5-5-3-3z"></path>
                                    </svg>
                                    @break
                                    
                                    @default
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" 
                                         stroke="currentColor" stroke-width="2">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                    </svg>
                                @endswitch
                            </div>
                            <h3>{{ $sport }}</h3>
                            <p>Профессиональные тренировки и программы в направлении {{ $sport }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </div>

    
    <section class="trainer-form-section" id="request-form">
        <div class="container">
            <div class="form-container-premium">
                <h2 class="form-title-premium">
                    Записаться к тренеру <span>{{ $trainer->name }}</span>
                </h2>
                
                <form id="trainerRequestForm">
                    @csrf
                    <input type="hidden" name="request_type" value="personal_training">
                    <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                    
                    <div class="form-group-premium">
                        <label for="full_name">ФИО</label>
                        <input type="text" name="full_name" id="full_name" 
                               class="form-control-premium" placeholder="Введите ваше полное имя" required>
                    </div>
                    
                    <div class="form-group-premium">
                        <label for="phone">Телефон</label>
                        <input type="tel" name="phone" id="phone" 
                               class="form-control-premium" placeholder="+7 (___) ___-__-__" required>
                    </div>
                    
                    <div class="form-group-premium">
                        <label for="email">Email (необязательно)</label>
                        <input type="email" name="email" id="email" 
                               class="form-control-premium" placeholder="example@email.com">
                    </div>
                    
                    <div class="form-group-premium">
                        <label for="message">Ваши цели и пожелания</label>
                        <textarea name="message" id="message" 
                                  class="form-control-premium" 
                                  placeholder="Опишите ваши цели, уровень подготовки и пожелания..." 
                                  rows="4"></textarea>
                    </div>
                    
                    <button type="submit" class="form-submit-btn-premium">
                        Отправить заявку
                    </button>
                </form>
            </div>
        </div>
    </section>

    
    <section class="other-trainers-section">
        <div class="container">
            <h2 class="section-title-premium">Другие <span>тренеры</span></h2>
            
            <div class="other-trainers-grid">
                @php
                    $otherTrainers = \App\Models\Trainer::where('id', '!=', $trainer->id)
                        ->active()
                        ->ordered()
                        ->limit(3)
                        ->get();
                @endphp
                
                @foreach($otherTrainers as $otherTrainer)
                <div class="other-trainer-card">
                    @if($otherTrainer->photo)
                    <img src="{{ asset('storage/' . $otherTrainer->photo) }}" 
                         alt="{{ $otherTrainer->name }}" 
                         class="other-trainer-photo" 
                         loading="lazy">
                    @else
                    <div class="other-trainer-photo" 
                         style="background: var(--color-light-gray); display: flex; align-items: center; justify-content: center;">
                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" 
                             stroke="var(--color-yellow)" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    @endif
                    
                    <div class="other-trainer-info">
                        <h3 class="other-trainer-name">{{ $otherTrainer->name }}</h3>
                        <p class="other-trainer-specialization">{{ $otherTrainer->specialization }}</p>
                        <a href="{{ route('trainer.show', $otherTrainer->id) }}" 
                           class="other-trainer-btn">
                            Профиль тренера
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="all-trainers-btn">
                <a href="{{ route('trainers') }}" class="btn-premium btn-outline-premium">
                    Все тренеры
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length > 0) {
                        if (!value.startsWith('7')) {
                            value = '7' + value;
                        }
                        
                        let formatted = '+7 (';
                        if (value.length > 1) {
                            formatted += value.substring(1, 4);
                        }
                        if (value.length >= 4) {
                            formatted += ') ' + value.substring(4, 7);
                        }
                        if (value.length >= 7) {
                            formatted += '-' + value.substring(7, 9);
                        }
                        if (value.length >= 9) {
                            formatted += '-' + value.substring(9, 11);
                        }
                        
                        this.value = formatted;
                    }
                });
            }
            
            
            const trainerRequestForm = document.getElementById('trainerRequestForm');
            if (trainerRequestForm) {
                trainerRequestForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    
                    submitBtn.textContent = 'Отправка...';
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
                                background: linear-gradient(135deg, var(--color-yellow), var(--color-yellow-dark));
                                color: var(--color-dark);
                                padding: 20px 30px;
                                border-radius: 12px;
                                z-index: 10000;
                                animation: fadeInUp 0.3s ease-out;
                                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                                font-family: 'Oswald', sans-serif;
                                font-weight: 600;
                                max-width: 350px;
                                border: 2px solid rgba(255, 215, 0, 0.3);
                            `;
                            alertDiv.innerHTML = `
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" 
                                         stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    <div>
                                        <div style="font-size: 1.1rem; margin-bottom: 5px;">Заявка отправлена!</div>
                                        <div style="font-size: 0.9rem; opacity: 0.9;">${data.message}</div>
                                    </div>
                                </div>
                            `;
                            document.body.appendChild(alertDiv);
                            
                            
                            setTimeout(() => {
                                alertDiv.style.animation = 'fadeOut 0.3s ease-out';
                                setTimeout(() => alertDiv.remove(), 300);
                            }, 5000);
                            
                            
                            setTimeout(() => this.reset(), 1000);
                        } else {
                            
                            const errorAlert = document.createElement('div');
                            errorAlert.style.cssText = `
                                position: fixed;
                                top: 20px;
                                right: 20px;
                                background: #dc3545;
                                color: white;
                                padding: 20px 30px;
                                border-radius: 12px;
                                z-index: 10000;
                                animation: fadeInUp 0.3s ease-out;
                                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                                font-family: 'Oswald', sans-serif;
                                font-weight: 600;
                                max-width: 350px;
                            `;
                            errorAlert.textContent = 'Ошибка при отправке заявки';
                            document.body.appendChild(errorAlert);
                            
                            setTimeout(() => {
                                errorAlert.style.animation = 'fadeOut 0.3s ease-out';
                                setTimeout(() => errorAlert.remove(), 300);
                            }, 5000);
                        }
                    } catch (error) {
                        
                        const networkAlert = document.createElement('div');
                        networkAlert.style.cssText = `
                            position: fixed;
                            top: 20px;
                            right: 20px;
                            background: #dc3545;
                            color: white;
                            padding: 20px 30px;
                            border-radius: 12px;
                            z-index: 10000;
                            animation: fadeInUp 0.3s ease-out;
                            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                            font-family: 'Oswald', sans-serif;
                            font-weight: 600;
                            max-width: 350px;
                        `;
                        networkAlert.textContent = 'Ошибка сети. Проверьте подключение.';
                        document.body.appendChild(networkAlert);
                        
                        setTimeout(() => {
                            networkAlert.style.animation = 'fadeOut 0.3s ease-out';
                            setTimeout(() => networkAlert.remove(), 300);
                        }, 5000);
                    } finally {
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }
            
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            
            document.querySelectorAll('.specialization-card, .achievement-card, .other-trainer-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
            
            
            const formContainer = document.querySelector('.form-container-premium');
            if (formContainer) {
                formContainer.style.opacity = '0';
                formContainer.style.transform = 'translateY(30px)';
                formContainer.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                observer.observe(formContainer);
            }
        });
    </script>
@endsection
