@extends('layouts.app')

@section('title', 'ReGYM - Лучший фитнес клуб в Кургане')
@section('content')
<style>

:root {
    --disc-opacity: 0.9;
}

.hero-hero{
    height: 550px;
    width: 405px;
    position: absolute;
    right: 110px;
    top: 12%;
    opacity: 0.8;
}

.hero-disc-left {
    left: -100px;
    bottom: -40px;
}

.hero-disc-right {
    right: 20px;
    top: 20%;
}


.hero-disc-left{
    position: absolute;
    width: 325px;
    height: 325px;
    z-index: 3;
    filter: 
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4))
        opacity(var(--disc-opacity));
}

.hero-disc-right{
    position: absolute;
    width: 250px;
    height: 250px;
    z-index: 3;
    filter: 
        drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4))
        opacity(var(--disc-opacity));
}

.hero-disc-left {
    animation: floatDiscLeft 3s infinite ease-in-out;
}

.hero-hero {
    animation: floatDiscLeft 10s infinite ease-in-out;
}

.hero-disc-right {
    animation: floatDiscRight 3s infinite ease-in-out 0.5s;
}

.hero-disc-left img,
.hero-disc-right img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
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


.hero-logo-title {
    display: flex;
    align-items: center; 
    gap: 12px;
    margin-bottom: 10px;
    animation: slideInLeft 1s ease-out 0.3s both;
}

.logo-img-hero {
    width: 65px;
    height: 65px;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.3));
    animation: pulse 2s infinite alternate;
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

.logo-text-hero {
    font-size: clamp(32px, 4.5vw, 48px);
    font-weight: 800;
    color: var(--color-white);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    line-height: 1;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.logo-yellow {
    color: var(--color-yellow);
    text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
}

.logo-white {
    color: var(--color-white);
}

.hero-subtitle-main {
    display: block;
    font-size: clamp(1.5rem, 3vw, 2.1rem);
    line-height: 1.1;
    margin-top: 5px;
    background: linear-gradient(90deg, var(--color-white), var(--color-yellow));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: slideInUp 1s ease-out 0.6s both;
}

.text-accent {
    color: var(--color-yellow);
    font-weight: 700;
    position: relative;
    display: inline-block;
}

.text-accent::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--color-yellow);
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s ease;
}

.text-accent:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

.hero {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    color: white;
    overflow: hidden;
    padding: 70px 0 25px;
    z-index: 1;
}

.hero-background-image {
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

.hero-overlay {
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

.hero-content {
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

.hero-text-wrapper {
    max-width: 780px;
    width: 100%;
    padding: 5px 20px;
    position: relative;
    z-index: 4;
    box-sizing: border-box;
}

.hero-title {
    font-size: clamp(1.8rem, 3.5vw, 2.4rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 0.6rem;
    position: relative;
}

.hero-subtitle {
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

.hero-subtitle br {
    display: block;
    margin: 4px 0;
}

.hero-actions {
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

.scroll-indicator {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 4;
    opacity: 0.7;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    40% {
        transform: translateX(-50%) translateY(-8px);
    }
    60% {
        transform: translateX(-50%) translateY(-4px);
    }
}

.scroll-indicator svg {
    width: 32px;
    height: 32px;
    fill: var(--color-yellow);
}


.services-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.service-card {
    background: var(--color-gray);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--color-border);
    position: relative;
    aspect-ratio: 1.5/1;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(255, 215, 0, 0.15);
    border-color: var(--color-yellow);
}

.service-image {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.service-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.6) 100%);
    z-index: 1;
    transition: all 0.4s ease;
}

.service-card:hover .service-image::before {
    background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%);
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card:hover .service-image img {
    transform: scale(1.1);
}

.service-content-basic {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 25px;
    background: rgba(0, 0, 0, 0.3);
    z-index: 2;
    transition: all 0.4s ease;
}

.service-content-basic h3 {
    font-size: clamp(22px, 2.2vw, 26px);
    margin-bottom: 15px;
    color: var(--color-white);
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.9);
    font-weight: 700;
    line-height: 1.2;
    transform: translateY(0);
    transition: transform 0.4s ease;
}

.service-card:hover .service-content-basic h3 {
    transform: translateY(-10px);
}

.service-content-expanded {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s ease;
    text-align: center;
    z-index: 3;
    transform: translateY(20px);
}

.service-card:hover .service-content-expanded {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.service-content-expanded h3 {
    font-size: clamp(22px, 2.2vw, 26px);
    margin-bottom: 20px;
    color: var(--color-yellow);
    font-weight: 700;
    line-height: 1.2;
    position: relative;
    padding-bottom: 10px;
}

.service-content-expanded h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--color-yellow);
    border-radius: 2px;
}

.service-content-expanded p {
    color: var(--color-text-light);
    margin-bottom: 25px;
    line-height: 1.5;
    font-size: clamp(12px, 1.3vw, 14px);
    max-height: 80px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

.trainer-action-wrapper {
    margin-top: auto;
    padding-top: 20px;
}


.gym-map-section {
    position: relative;
    overflow: hidden;
    padding: 80px 0;
    background: var(--color-dark); 
}

.gym-map-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
}

.gym-map-preview-large {
    width: 100%;
    aspect-ratio: 16/9;
    background: linear-gradient(135deg, #0f1525 0%, #1a1f32 100%);
    border-radius: 10px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border: 2px solid rgba(255, 215, 0, 0.3);
    margin-bottom: 30px;
    transition: all 0.4s ease;
    transform-origin: center center;
}

.gym-map-preview-large:hover {
    border-color: rgba(255, 215, 0, 0.5);
    box-shadow: 0 25px 70px rgba(255, 215, 0, 0.15);
}

.grid-background-enhanced {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(to right, rgba(255, 215, 0, 0.08) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 215, 0, 0.08) 1px, transparent 1px);
    background-size: calc(100% / 60) calc(100% / 24);
    pointer-events: none;
}


.zone-item-enhanced {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    text-align: center;
    overflow: hidden;
    border-radius: 8px;
    pointer-events: none;
    z-index: 2;
    box-shadow: 
        0 4px 12px rgba(0, 0, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(4px);
    box-sizing: border-box;
    cursor: default;
    transform-origin: center center;
    
    min-width: 30px;
    min-height: 30px;
}


.zone-item-large {
    min-width: 40px;
    min-height: 40px;
    font-size: 12px;
    border-radius: 10px;
    z-index: 1;
}

.zone-item-medium {
    min-width: 25px;
    min-height: 25px;
    font-size: 10px;
    border-radius: 8px;
    z-index: 2;
}

.zone-item-small {
    min-width: 20px;
    min-height: 20px;
    font-size: 8px;
    border-radius: 6px;
    z-index: 3;
}

.zone-item-tiny {
    min-width: 15px;
    min-height: 15px;
    font-size: 7px;
    border-radius: 4px;
    z-index: 4;
    box-shadow: 
        0 3px 8px rgba(0, 0, 0, 0.4),
        0 0 0 2px rgba(255, 215, 0, 0.3) !important;
}

.zone-item-micro {
    min-width: 12px;
    min-height: 12px;
    font-size: 6px;
    border-radius: 3px;
    z-index: 5;
    box-shadow: 
        0 2px 6px rgba(0, 0, 0, 0.5),
        0 0 0 1px rgba(255, 215, 0, 0.4) !important;
}


.zone-item-enhanced:hover,
.zone-item-large:hover,
.zone-item-medium:hover,
.zone-item-small:hover,
.zone-item-tiny:hover,
.zone-item-micro:hover {
    transform: none !important;
    box-shadow: 
        0 4px 12px rgba(0, 0, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1) !important;
}


.zone-label {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-overflow: ellipsis;
    overflow: hidden;
    text-shadow: 
        1px 1px 2px rgba(0, 0, 0, 0.8),
        0 0 8px rgba(0, 0, 0, 0.5);
    line-height: 1;
    font-weight: 800;
    
    font-size: calc(50% + 0.5vw);
    transform-origin: center center;
}


.zone-item-tiny .zone-label,
.zone-item-micro .zone-label {
    font-size: 100%;
    padding: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex;
    align-items: center;
    justify-content: center;
}


.gym-map-btn {
    font-size: 16px;
    padding: 15px 35px;
    background: linear-gradient(135deg, var(--color-yellow), #fbbf24);
    color: var(--color-black);
    border: none;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
    font-weight: 600;
    margin-top: 30px;
    position: relative;
    overflow: hidden;
}

.gym-map-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(255, 215, 0, 0.4);
    background: linear-gradient(135deg, #fbbf24, var(--color-yellow));
}

.gym-map-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: 0.5s;
}

.gym-map-btn:hover::before {
    left: 100%;
}

.gym-map-btn svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}


.quote-section-enhanced {
    padding: 100px 0;
    background: linear-gradient(135deg, 
        rgba(15, 21, 37, 0.98) 0%, 
        rgba(26, 31, 50, 0.95) 100%); 
    position: relative;
    overflow: hidden;
}

.quote-section-enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 30%, rgba(255, 215, 0, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 215, 0, 0.05) 0%, transparent 50%);
    animation: gradientShift 15s ease-in-out infinite alternate;
}

@keyframes gradientShift {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.1);
    }
}

.quote-container-enhanced {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
}


.quote-layout-enhanced {
    display: flex;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
    position: relative;
    min-height: 500px;
}


.quote-photo-wrapper {
    position: relative;
    flex: 0 0 450px;
    margin: 0 auto;
}

.quote-icon-overlay {
    position: absolute;
    top: -30px;
    left: -30px;
    width: 120px;
    height: 120px;
    z-index: 10;
    animation: iconFloat 6s ease-in-out infinite;
}

.quote-icon-overlay svg {
    width: 100%;
    height: 100%;
    fill: var(--color-yellow);
    opacity: 0.9;
    filter: 
        drop-shadow(0 0 15px rgba(255, 215, 0, 0.3))
        drop-shadow(0 0 30px rgba(255, 215, 0, 0.2));
    stroke-width: 1.5;
}

.quote-photo-enhanced {
    position: relative;
    transform-style: preserve-3d;
    perspective: 1000px;
    width: 100%;
    margin-top: 20px; 
}

.quote-photo-enhanced::before {
    content: '';
    position: absolute;
    top: -20px;
    left: -20px;
    width: 100%;
    height: 100%;
    border: 3px solid var(--color-yellow);
    border-radius: 15px;
    z-index: -1;
    opacity: 0.5;
    transform: translateZ(-20px);
    transition: all 0.5s ease;
}

.quote-photo-enhanced:hover::before {
    transform: translateZ(-10px) rotate(3deg);
    opacity: 0.8;
}

.quote-photo-enhanced::after {
    content: '';
    position: absolute;
    top: 10px;
    left: 10px;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, 
        transparent 0%,
        rgba(255, 215, 0, 0.1) 100%);
    border-radius: 15px;
    z-index: 2;
    pointer-events: none;
}

.quote-photo-enhanced img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.5),
        0 0 100px rgba(255, 215, 0, 0.1);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
    filter: saturate(1.1) contrast(1.05);
}

.quote-photo-enhanced:hover img {
    transform: 
        scale(1.02)
        rotateX(2deg)
        rotateY(-2deg);
    box-shadow: 
        0 35px 70px rgba(0, 0, 0, 0.6),
        0 0 150px rgba(255, 215, 0, 0.15);
}


.quote-content-enhanced {
    flex: 1;
    min-width: 300px;
    position: relative;
    padding-left: 40px;
    text-align: left;
}


@media (max-width: 768px) {
    .quote-content-enhanced {
        text-align: center;
        padding-left: 0;
        padding-top: 20px; 
    }
}

.quote-text-enhanced {
    font-size: clamp(32px, 4vw, 42px);
    margin: 30px 0;
    color: var(--color-white);
    line-height: 1.3;
    font-weight: 700;
    position: relative;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
}

.quote-text-enhanced::before {
    content: '"';
    position: absolute;
    top: -40px;
    left: 0;
    font-size: 120px;
    color: var(--color-yellow);
    opacity: 0.2;
    font-family: serif;
    line-height: 1;
    animation: quotePulse 4s ease-in-out infinite;
}

.quote-author-enhanced {
    font-size: clamp(20px, 2vw, 24px);
    color: var(--color-yellow);
    font-weight: 600;
    margin-top: 30px;
    padding-top: 20px;
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.quote-author-enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, 
        var(--color-yellow) 0%,
        transparent 100%);
    border-radius: 2px;
}

.author-badge {
    background: rgba(255, 215, 0, 0.1);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 215, 0, 0.3);
    backdrop-filter: blur(10px);
    align-self: flex-start;
}

.quote-description {
    margin-top: 25px;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
    font-size: 16px;
    font-style: italic;
    border-left: 3px solid rgba(255, 215, 0, 0.3);
    padding-left: 20px;
}


.quote-decoration {
    position: absolute;
    right: 0;
    bottom: 0;
    width: 200px;
    height: 200px;
    opacity: 0.1;
    pointer-events: none;
}

.quote-decoration svg {
    width: 100%;
    height: 100%;
    fill: var(--color-yellow);
}


@keyframes iconFloat {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-10px) rotate(5deg);
    }
}

@keyframes quotePulse {
    0%, 100% {
        opacity: 0.2;
        transform: scale(1);
    }
    50% {
        opacity: 0.3;
        transform: scale(1.05);
    }
}


.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 50px;
}

.feature-card {
    background: #383a4b;
    border-radius: 12px;
    padding: 35px 25px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 215, 0, 0.1);
    backdrop-filter: blur(10px);
}

.feature-card:hover {
    transform: translateY(-5px);
    border-color: var(--color-yellow);
    box-shadow: 0 10px 25px rgba(255, 215, 0, 0.1);
    background: rgba(255, 255, 255, 0.08);
}

.feature-icon {
    width: 70px;
    height: 70px;
    background: rgba(255, 215, 0, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    background: rgba(255, 215, 0, 0.2);
    transform: scale(1.1);
}

.feature-icon svg {
    width: 32px;
    height: 32px;
    stroke: var(--color-yellow);
}

.feature-card h3 {
    font-size: 20px;
    margin-bottom: 12px;
    color: var(--color-white);
}

.feature-card p {
    color: var(--color-text-light);
    line-height: 1.5;
    font-size: 15px;
}


.trainers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.trainer-card {
    background: var(--color-gray);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--color-border);
    display: flex;
    flex-direction: column;
    min-height: 550px; 
}

.trainer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(255, 215, 0, 0.15);
    border-color: var(--color-yellow);
}

.trainer-photo {
    width: 100%;
    height: 350px; 
    object-fit: cover;
    transition: transform 0.5s ease;
    flex-shrink: 0;
}

.trainer-card:hover .trainer-photo {
    transform: scale(1.05);
}

.trainer-info {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.trainer-name {
    font-size: 1.4rem;
    margin-bottom: 8px;
    color: var(--color-white);
}

.trainer-specialization {
    color: var(--color-yellow);
    font-weight: 600;
    margin-bottom: 15px;
}

.trainer-sports {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
}

.sport-tag {
    background: rgba(255, 215, 0, 0.1);
    color: var(--color-yellow);
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
    border: 1px solid rgba(255, 215, 0, 0.2);
}


.form-container {
    max-width: 600px;
    margin: 0 auto;
    background: var(--color-gray);
    padding: 40px;
    border-radius: 12px;
    border: 1px solid var(--color-border);
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

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    color: var(--color-white);
    font-weight: 600;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    color: var(--color-white);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--color-yellow);
    background: rgba(255, 255, 255, 0.08);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}


.map-container {
    width: 100%;
    height: 400px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 30px;
    border: 2px solid rgba(255, 215, 0, 0.3);
}

.contact-info {
    text-align: center;
    color: var(--color-white);
    font-size: 1.1rem;
    line-height: 1.8;
    padding: 20px 20px; 
}

.contact-info a {
    color: var(--color-yellow);
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-info a:hover {
    color: white;
    text-decoration: underline;
}


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(100px);
    }
}

.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 350px;
}

.notification {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: #000000 !important; 
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 15px;
    animation: fadeIn 0.3s ease-out;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    border-left: 4px solid #f59e0b;
}

.notification.success {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: #000000 !important; 
}

.notification.error {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white !important;
    border-left: 4px solid #dc2626;
}

.notification.fade-out {
    animation: fadeOut 0.3s ease-out;
}






@media (max-width: 1170px) {
    .hero-hero {
        opacity: 0;
        visibility: hidden;
        display: none;
    }
    
    .hero-content {
        justify-content: center;
    }
    
    .hero-text-wrapper {
        margin: 0 auto;
        max-width: 90%;
        padding: 5px 40px;
        text-align: left;
    }
    
    .hero-logo-title {
        flex-direction: row;
        justify-content: flex-start;
        text-align: left;
    }
    
    .hero-disc-left {
        left: 5%;
        bottom: 10%;
        width: 280px;
        height: 280px;
    }
    
    .hero-disc-right {
        right: 5%;
        top: 20%;
        width: 220px;
        height: 220px;
    }
    
    .hero-title {
        text-align: left;
    }
    
    .hero-subtitle {
        text-align: left;
    }
    
    .hero-actions {
        width: 100%;
        max-width: 100%;
        justify-content: flex-start;
    }
    
    
    .quote-layout-enhanced {
        gap: 40px;
    }
    
    .quote-photo-wrapper {
        flex: 0 0 380px;
    }
    
    .quote-photo-enhanced img {
        height: 420px;
    }
    
    .quote-icon-overlay {
        top: -25px;
        left: -25px;
        width: 100px;
        height: 100px;
    }
    
    .quote-text-enhanced {
        font-size: clamp(28px, 3.5vw, 36px);
    }
    
    .quote-content-enhanced {
        padding-left: 30px;
    }
}


@media (max-height: 900px) and (min-width: 768px) {
    .hero-disc-left {
        width: calc(325px * 0.8);
        height: calc(325px * 0.8);
        bottom: 5%;
        left: 5%;
    }
    
    .hero-disc-right {
        width: calc(250px * 0.8);
        height: calc(250px * 0.8);
        top: 15%;
        right: 5%;
    }
    
    .hero {
        min-height: 70vh;
    }
    
    .hero-content {
        min-height: calc(70vh - 50px);
        padding-bottom: 60px;
    }
    
    .logo-img-hero {
        width: 55px;
        height: 55px;
    }
    
    .logo-text-hero {
        font-size: clamp(28px, 4vw, 40px);
    }
    
    .hero-subtitle-main {
        font-size: clamp(1.3rem, 2.5vw, 1.8rem);
    }
    
    .hero-subtitle {
        font-size: clamp(0.85rem, 1.4vw, 1rem);
    }
    
    .btn-primary,
    .btn-outline-light {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    
    .gym-map-preview-large {
        aspect-ratio: 3/2;
    }
    
    .zone-item-large {
        min-width: 35px;
        min-height: 35px;
        font-size: 11px;
    }
    
    .zone-item-medium {
        min-width: 22px;
        min-height: 22px;
        font-size: 9px;
    }
    
    .zone-item-small {
        min-width: 18px;
        min-height: 18px;
        font-size: 7px;
    }
    
    .zone-item-tiny {
        min-width: 14px;
        min-height: 14px;
        font-size: 6px;
    }
    
    .zone-item-micro {
        min-width: 11px;
        min-height: 11px;
        font-size: 5px;
    }
    
    
    .quote-photo-enhanced img {
        height: 350px;
    }
    
    .quote-icon-overlay {
        top: -20px;
        left: -20px;
        width: 80px;
        height: 80px;
    }
}


@media (max-width: 1024px) {
    .hero-text-wrapper {
        padding: 5px 30px;
    }
    
    
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
    
    .service-card {
        aspect-ratio: 16/9;
    }
    
    .service-content-basic {
        padding: 20px;
    }
    
    .service-content-expanded {
        padding: 25px;
    }
    
    .service-content-expanded p {
        font-size: 11px;
        line-height: 1.3;
        -webkit-line-clamp: 3;
        max-height: 60px;
    }
    
    
    .gym-map-section {
        padding: 60px 0;
    }
    
    .gym-map-preview-large {
        aspect-ratio: 4/3;
    }
    
    
    .zone-item-large {
        min-width: 30px;
        min-height: 30px;
        font-size: 10px;
    }
    
    .zone-item-medium {
        min-width: 20px;
        min-height: 20px;
        font-size: 8px;
    }
    
    .zone-item-small {
        min-width: 16px;
        min-height: 16px;
        font-size: 7px;
    }
    
    .zone-item-tiny {
        min-width: 12px;
        min-height: 12px;
        font-size: 6px;
    }
    
    .zone-item-micro {
        min-width: 10px;
        min-height: 10px;
        font-size: 5px;
    }
    
    
    .quote-layout-enhanced {
        gap: 30px;
    }
    
    .quote-photo-wrapper {
        flex: 0 0 350px;
    }
    
    .quote-photo-enhanced img {
        height: 380px;
    }
    
    .quote-icon-overlay {
        top: -20px;
        left: -20px;
        width: 80px;
        height: 80px;
    }
    
    
    .trainers-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
    
    .trainer-card {
        min-height: 520px;
    }
    
    .trainer-photo {
        height: 320px;
    }
    
    
    .form-container {
        padding: 30px;
    }
    
    
    .gym-map-btn {
        font-size: 14px;
        padding: 12px 25px;
        gap: 8px;
    }
    
    .gym-map-btn svg {
        width: 16px;
        height: 16px;
    }
}





@media (max-width: 768px) {
    
    .hero-text-wrapper {
        padding: 5px 20px;
        max-width: 100%;
    }
    
    .hero-background-image {
        background-attachment: scroll;
        animation: none;
    }
    
    .hero-disc-left {
        width: 150px;
        height: 150px;
        left: 5%;
        bottom: 5%;
    }
    
    .hero-disc-right {
        width: 120px;
        height: 120px;
        right: 5%;
        top: 15%;
    }
    
    .hero {
        padding: 60px 0 20px;
        min-height: 80vh;
    }
    
    .hero-content {
        padding-bottom: 40px;
        min-height: calc(80vh - 40px);
    }
    
    .hero-logo-title {
        flex-direction: row;
        gap: 8px;
        text-align: left;
        margin-bottom: 20px;
        justify-content: flex-start;
    }
    
    .logo-img-hero {
        width: 50px;
        height: 50px;
    }
    
    .logo-text-hero {
        font-size: clamp(24px, 3.5vw, 32px);
    }
    
    .hero-subtitle-main {
        font-size: clamp(1.2rem, 2.2vw, 1.5rem);
        margin-top: 10px;
        text-align: left;
    }
    
    .hero-title {
        font-size: clamp(1.5rem, 3vw, 1.8rem);
        text-align: left;
    }
    
    .hero-subtitle {
        font-size: clamp(0.8rem, 1.2vw, 0.95rem);
        line-height: 1.4;
        text-align: left;
        padding-left: 10px;
        border-left-width: 2px;
    }
    
    .hero-subtitle br {
        display: none;
    }
    
    .hero-subtitle strong {
        display: inline;
    }
    
    .hero-actions {
        flex-direction: column;
        width: 100%;
        max-width: 100%;
        gap: 12px;
        align-items: flex-start;
    }
    
    .btn-primary,
    .btn-outline-light {
        width: 100%;
        max-width: 100%;
        padding: 12px 20px;
    }
    
    .scroll-indicator {
        display: none;
    }
    
    
    .services-grid {
        grid-template-columns: 1fr;
        gap: 25px;
        max-width: 100%;
        padding: 0 20px;
    }
    
    .service-card {
        aspect-ratio: 3/2;
        width: 100%;
    }
    
    .service-content-basic {
        padding: 15px;
    }
    
    .service-content-basic h3 {
        font-size: 20px;
        margin-bottom: 8px;
    }
    
    .service-content-expanded p {
        font-size: 10px;
        line-height: 1.1;
        -webkit-line-clamp: 3;
        max-height: 45px;
    }
    
    
    .gym-map-section {
        padding: 40px 0;
        overflow: hidden;
    }

    .gym-map-container {
        width: 100%;
        overflow: visible;
        padding: 0 20px;
    }

    
    .gym-map-preview-large {
        margin: 20% auto 20%; 
        transform: rotate(90deg);
        width: 120vw; 
        position: relative;
        left: 50%;
        transform: translateX(-50%) rotate(90deg); 
    }

    .zone-label {
        font-size: 12px; 
        font-weight: 800; 
        padding: 0;
        
        text-shadow: 
            1px 1px 1px rgba(0, 0, 0, 0.7), 
            0 0 2px rgba(0, 0, 0, 0.5); 
        letter-spacing: 0.2px; 
    }
    
    .gym-map-preview-large .zone-label {
        transform: rotate(-90deg) scale(1); 
        font-size: 12px; 
    }

    
    .zone-item-enhanced {
        min-width: 18px;
        min-height: 18px;
        font-size: 8px;
    }

    
    .zone-item-large { 
        min-width: 20px;
        min-height: 20px;
        font-size: 8px;
        border-radius: 6px;
    }
    
    .zone-item-medium { 
        min-width: 15px;
        min-height: 15px;
        font-size: 7px;
        border-radius: 5px;
    }
    
    .zone-item-small { 
        min-width: 12px;
        min-height: 12px;
        font-size: 6px;
        border-radius: 4px;
    }
    
    .zone-item-tiny { 
        min-width: 10px;
        min-height: 10px;
        font-size: 5px;
        border-radius: 3px;
    }
    
    .zone-item-micro { 
        min-width: 8px;
        min-height: 8px;
        font-size: 4px;
        border-radius: 2px;
    }

    
    .gym-map-btn {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        font-size: 13px;
        padding: 10px 20px;
        gap: 6px;
        width: 100%;
        max-width: 280px;
        margin: 20px auto 0;
    }
    
    .gym-map-btn svg {
        width: 14px;
        height: 14px;
    }
    
    
    .quote-section-enhanced {
        padding: 80px 0;
    }
    
    .quote-layout-enhanced {
        flex-direction: column;
        gap: 30px; 
        text-align: center;
        min-height: auto;
    }
    
    .quote-photo-wrapper {
        flex: 0 0 auto;
        width: 100%;
        max-width: 280px;
        margin: 0 auto;
    }
    
    .quote-photo-enhanced {
        margin-top: 40px;
    }
    
    .quote-photo-enhanced::before {
        top: -10px;
        left: -10px;
        border-width: 2px;
    }
    
    .quote-photo-enhanced img {
        height: 280px;
    }
    
    .quote-icon-overlay {
        top: -15px;
        left: -15px;
        width: 60px;
        height: 60px;
    }
    
    .quote-content-enhanced {
        text-align: center;
        padding-left: 0;
        padding-top: 20px; 
    }
    
    .quote-text-enhanced {
        padding-left: 0;
        font-size: clamp(20px, 2.5vw, 26px);
        margin: 15px 0;
    }
    
    .quote-text-enhanced::before {
        left: 50%;
        transform: translateX(-50%);
        font-size: 80px;
        top: -20px;
    }
    
    .quote-author-enhanced {
        justify-content: center;
        font-size: 16px;
        margin-top: 15px;
        padding-top: 15px;
        flex-direction: column;
        gap: 10px;
    }
    
    .quote-author-enhanced::before {
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
    }
    
    .author-badge {
        align-self: center;
        font-size: 12px;
        padding: 4px 10px;
    }
    
    .quote-description {
        text-align: center;
        border-left: none;
        padding-left: 0;
        border-top: 2px solid rgba(255, 215, 0, 0.2);
        padding-top: 10px;
        margin-top: 20px;
        font-size: 14px;
    }
    
    
    .trainers-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0 20px;
    }
    
    .trainer-card {
        flex-direction: column;
        min-height: 500px; 
        width: 100%; 
        max-width: 100%; 
    }
    
    .trainer-photo {
        height: 300px;
        width: 100%; 
    }
    
    .service-content-basic h3 {
        font-size: 18px;
    }
    
    
    .form-container {
        padding: 20px;
        margin: 0 20px;
        width: calc(100% - 40px);
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    
    .map-container {
        height: 300px;
        margin: 0 20px 20px;
        width: calc(100% - 40px);
    }
    
    
    .contact-info {
        font-size: 14px;
        padding: 20px 30px; 
        text-align: center;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
    }
}





@media (max-width: 768px) and (orientation: landscape) {
        
    .zone-label {
        font-size: 12px; 
        font-weight: 800; 
        padding: 0;
        
        text-shadow: 
            1px 1px 1px rgba(0, 0, 0, 0.7), 
            0 0 2px rgba(0, 0, 0, 0.5); 
        letter-spacing: 0.2px; 
    }
    
    .gym-map-preview-large .zone-label {
        transform: rotate(-90deg) scale(1); 
        font-size: 12px; 
    }
    
    .zone-item-large {
        min-width: 22px;
        min-height: 22px;
        font-size: 9px;
    }
    
    .zone-item-medium {
        min-width: 17px;
        min-height: 17px;
        font-size: 8px;
    }
    
    .zone-item-small {
        min-width: 14px;
        min-height: 14px;
        font-size: 7px;
    }
    
    .zone-item-tiny {
        min-width: 11px;
        min-height: 11px;
        font-size: 6px;
    }
    
    .zone-item-micro {
        min-width: 9px;
        min-height: 9px;
        font-size: 5px;
    }
    
    
    .trainers-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .trainer-card {
        min-height: 450px;
    }
    
    .trainer-photo {
        height: 250px;
    }
    
    
    .contact-info {
        text-align: center;
        color: var(--color-white);
        font-size: 1.1rem;
        line-height: 1.8;
        padding: 20px 20px; 
    }
}


@media (max-width: 480px) {
    .hero-text-wrapper {
        padding: 5px 15px;
    }
    
    .hero-disc-left {
        width: 120px;
        height: 120px;
        left: 3%;
        bottom: 3%;
    }
    
    .hero-disc-right {
        width: 100px;
        height: 100px;
        right: 3%;
        top: 12%;
    }
    
    .hero-logo-title {
        gap: 6px;
    }
    
    .logo-img-hero {
        width: 40px;
        height: 40px;
    }
    
    .logo-text-hero {
        font-size: 22px;
    }
    
    .hero-title {
        text-align: left;
    }
    
    .hero-subtitle-main {
        text-align: left;
    }
    
    
    .services-grid {
        gap: 20px;
        padding: 0 15px;
    }
    
    .service-card {
        aspect-ratio: 3/2;
    }
    
    .service-content-basic {
        padding: 12px;
    }
    
    .service-content-basic h3 {
        font-size: 18px;
        margin-bottom: 6px;
    }
    
    .service-content-expanded p {
        font-size: 9px;
        line-height: 1.1;
        -webkit-line-clamp: 3;
        max-height: 40px;
    }
    
    
    .gym-map-preview-large {
        margin: 20% auto 20%; 
        transform: rotate(90deg);
        width: 120vw; 
        position: relative;
        left: 50%;
        transform: translateX(-50%) rotate(90deg); 
    }
    
    
    
    .gym-map-container {
        padding: 0 15px;
    }
    
    
    .zone-item-enhanced {
        font-size: 10px; 
    }

    
    .zone-item-large {
        min-width: 18px;
        min-height: 18px;
        font-size: 7px;
        border-radius: 5px;
    }
    
    .zone-item-medium {
        min-width: 14px;
        min-height: 14px;
        font-size: 6px;
        border-radius: 4px;
    }
    
    .zone-item-small {
        min-width: 11px;
        min-height: 11px;
        font-size: 5px;
        border-radius: 3px;
    }
    
    .zone-item-tiny {
        min-width: 9px;
        min-height: 9px;
        font-size: 4px;
        border-radius: 2px;
    }
    
    .zone-item-micro {
        min-width: 7px;
        min-height: 7px;
        font-size: 3px;
        border-radius: 2px;
    }
    
    
    .zone-label {
        font-size: 10px; 
        font-weight: 800; 
        padding: 0;
        
        text-shadow: 
            1px 1px 1px rgba(0, 0, 0, 0.7), 
            0 0 2px rgba(0, 0, 0, 0.5); 
        letter-spacing: 0.2px; 
    }
    
    
    .gym-map-preview-large .zone-label {
        transform: rotate(-90deg) scale(1); 
        font-size: 10px; 
    }
    
    
    .contact-info {
        text-align: center;
        color: var(--color-white);
        font-size: 0.9rem;
        line-height: 1.8;
        padding: 20px 20px; 
    }
}


@media (max-width: 430px) {
    .hero-text-wrapper {
        padding: 5px 12px;
    }
    
    .hero-disc-left {
        width: 100px;
        height: 100px;
        left: 2%;
        bottom: 2%;
    }
    
    .hero-disc-right {
        width: 80px;
        height: 80px;
        right: 2%;
        top: 10%;
    }
    
    .logo-img-hero {
        width: 35px;
        height: 35px;
    }
    
    .logo-text-hero {
        font-size: 20px;
    }
    
    .hero-subtitle-main {
        font-size: 1.1rem;
    }
    
    .hero-title {
        font-size: 1.3rem;
    }
    
    .hero-subtitle {
        font-size: 0.75rem;
    }
    
    
    .services-grid {
        gap: 15px;
        padding: 0 12px;
    }
    
    .service-card {
        aspect-ratio: 4/3;
    }
    
    .service-content-basic h3 {
        font-size: 16px;
    }
    
    
    .gym-map-preview-large {
        margin: 20% auto 20%; 
        transform: rotate(90deg);
        width: 110vw; 
        max-width: 480px; 
        position: relative;
        left: 50%;
        transform: translateX(-50%) rotate(90deg); 
    }   
    
    
    .zone-item-enhanced {
        font-size: 7px; 
    }
    
    
    .zone-item-large {
        min-width: 18px; 
        min-height: 18px; 
        font-size: 7px; 
        border-radius: 4px;
    }
    
    .zone-item-medium {
        min-width: 14px; 
        min-height: 14px; 
        font-size: 6px; 
        border-radius: 3px;
    }
    
    .zone-item-small {
        min-width: 12px; 
        min-height: 12px; 
        font-size: 5px; 
        border-radius: 3px;
    }
    
    .zone-item-tiny {
        min-width: 10px; 
        min-height: 10px; 
        font-size: 4px; 
        border-radius: 2px;
    }
    
    .zone-item-micro {
        min-width: 8px; 
        min-height: 8px; 
        font-size: 3px; 
        border-radius: 1px;
    }
    
    .zone-label {
        font-size: 10px; 
        font-weight: 800; 
        padding: 0;
        
        text-shadow: 
            1px 1px 1px rgba(0, 0, 0, 0.7), 
            0 0 2px rgba(0, 0, 0, 0.5); 
        letter-spacing: 0.2px; 
    }
    
    .gym-map-preview-large .zone-label {
        transform: rotate(-90deg) scale(1); 
        font-size: 10px; 
    }
    
    .gym-map-container {
        padding: 0 12px;
    }
    
    
    .quote-photo-wrapper {
        max-width: 220px;
    }
    
    .quote-photo-enhanced img {
        height: 220px;
    }
    
    .quote-icon-overlay {
        width: 40px;
        height: 40px;
    }
    
    .quote-text-enhanced {
        font-size: clamp(16px, 2vw, 20px);
    }
    
    .quote-text-enhanced::before {
        font-size: 60px;
    }
    
    
    .gym-map-btn {
        font-size: 11px;
        padding: 7px 14px;
        max-width: 220px;
    }
    
    
    .contact-info {
        text-align: center;
        color: var(--color-white);
        font-size: 0.9rem;
        line-height: 1.8;
        padding: 20px 20px; 
    }
}


@media (max-width: 360px) {
    .hero-text-wrapper {
        padding: 5px 10px;
    }
    
    .hero-disc-left {
        width: 80px;
        height: 80px;
        left: 1%;
        bottom: 1%;
    }
    
    .hero-disc-right {
        width: 70px;
        height: 70px;
        right: 1%;
        top: 8%;
    }
    
    .logo-img-hero {
        width: 30px;
        height: 30px;
    }
    
    .logo-text-hero {
        font-size: 18px;
    }
    
    
    .services-grid {
        gap: 12px;
        padding: 0 10px;
    }
    
    
    .gym-map-preview-large {
        margin: 20% auto 20%; 
        transform: rotate(90deg);
        width: 110vw; 
        max-width: 400px; 
        position: relative;
        left: 50%;
        transform: translateX(-50%) rotate(90deg); 
    }
    
    
    .zone-item-enhanced {
        font-size: 6px;
    }
    
    
    .zone-item-large {
        min-width: 16px; 
        min-height: 16px; 
        font-size: 6px; 
        border-radius: 4px;
    }
    
    .zone-item-medium {
        min-width: 12px; 
        min-height: 12px; 
        font-size: 5px; 
        border-radius: 3px;
    }
    
    .zone-item-small {
        min-width: 10px; 
        min-height: 10px; 
        font-size: 4px; 
        border-radius: 3px;
    }
    
    .zone-item-tiny {
        min-width: 8px; 
        min-height: 8px; 
        font-size: 3px; 
        border-radius: 2px;
    }
    
    .zone-item-micro {
        min-width: 6px; 
        min-height: 6px; 
        font-size: 2px; 
        border-radius: 1px;
    }
    
    
    .zone-label {
        font-size: 10px; 
        font-weight: 800; 
        padding: 0;
        
        text-shadow: 
            1px 1px 1px rgba(0, 0, 0, 0.7), 
            0 0 2px rgba(0, 0, 0, 0.5); 
        letter-spacing: 0.2px; 
    }
    
    .gym-map-preview-large .zone-label {
        transform: rotate(-90deg) scale(1); 
        font-size: 10px; 
    }
    
    .gym-map-container {
        padding: 0 10px;
    }
    
    
    .quote-photo-wrapper {
        max-width: 200px;
    }
    
    .quote-photo-enhanced img {
        height: 200px;
    }
    
    
    .zone-item-micro {
        z-index: 15 !important;
    }
    
    
    .contact-info {
        text-align: center;
        color: var(--color-white);
        font-size: 0.8rem;
        line-height: 1.8;
        padding: 20px 20px; 
    }
}


@media (max-height: 600px) and (orientation: landscape) {
    .hero {
        min-height: 100vh;
    }
    
    .hero-content {
        min-height: calc(100vh - 60px);
        padding-bottom: 30px;
    }
    
    .hero-text-wrapper {
        padding: 5px 20px;
    }
    
    .hero {
        padding-top: 50px;
    }
    
    .hero-logo-title {
        flex-direction: row;
        margin-bottom: 10px;
        justify-content: flex-start;
    }
    
    .logo-img-hero {
        width: 40px;
        height: 40px;
    }
    
    .logo-text-hero {
        font-size: 28px;
    }
    
    .hero-subtitle-main {
        font-size: 1.2rem;
        margin-top: 5px;
        text-align: left;
    }
    
    .hero-subtitle {
        font-size: 0.8rem;
        margin-bottom: 15px;
        text-align: left;
    }
    
    .hero-disc-left {
        width: 100px;
        height: 100px;
    }
    
    .hero-disc-right {
        width: 80px;
        height: 80px;
    }
    
    .hero-actions {
        gap: 10px;
        max-width: 100%;
        justify-content: flex-start;
    }
    
    .btn-primary,
    .btn-outline-light {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
    
    
    .gym-map-preview-large {
        transform: none;
        width: calc(100vw - 40px);
        height: auto;
        aspect-ratio: 16/9;
        max-height: 60vh;
        margin: 15px auto 30px;
    }
    
    .gym-map-preview-large .zone-item-enhanced {
        transform: none;
    }
    
    .zone-item-large {
        min-width: 20px;
        min-height: 20px;
        font-size: 8px;
    }
    
    .zone-item-medium {
        min-width: 16px;
        min-height: 16px;
        font-size: 7px;
    }
    
    .zone-item-small {
        min-width: 13px;
        min-height: 13px;
        font-size: 6px;
    }
    
    .zone-item-tiny {
        min-width: 10px;
        min-height: 10px;
        font-size: 5px;
    }
    
    .zone-item-micro {
        min-width: 8px;
        min-height: 8px;
        font-size: 4px;
    }
    
    
    .quote-section-enhanced {
        padding: 60px 0;
    }
    
    .quote-layout-enhanced {
        flex-direction: row;
        gap: 20px;
        min-height: auto;
    }
    
    .quote-photo-wrapper {
        flex: 0 0 200px;
    }
    
    .quote-photo-enhanced img {
        height: 200px;
    }
    
    .quote-icon-overlay {
        width: 50px;
        height: 50px;
    }
    
    .quote-text-enhanced {
        font-size: 18px;
    }
    
    .quote-author-enhanced {
        font-size: 14px;
    }
    
    
    .trainers-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .trainer-card {
        min-height: 400px;
    }
    
    .trainer-photo {
        height: 200px;
    }
}


@media (max-width: 375px) {
    .zone-item-large {
        min-width: 12px;
        min-height: 12px;
    }
    
    .zone-item-medium {
        min-width: 10px;
        min-height: 10px;
    }
    
    .zone-item-small {
        min-width: 8px;
        min-height: 8px;
    }
    
    .zone-item-tiny {
        min-width: 6px;
        min-height: 6px;
    }
    
    .zone-item-micro {
        min-width: 5px;
        min-height: 5px;
        z-index: 10 !important;
    }
    
    
    .trainer-card {
        min-height: 420px;
    }
    
    .trainer-photo {
        height: 220px;
    }
}


@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}


@media (prefers-color-scheme: dark) {
    .hero-overlay {
        background: linear-gradient(135deg, 
            rgba(0, 0, 0, 0.95) 0%, 
            rgba(29, 31, 43, 0.92) 40%, 
            rgba(29, 31, 43, 0.7) 100%);
    }
    
    .service-content-expanded {
        background: rgba(0, 0, 0, 0.95);
    }
    
    .gym-map-preview-large {
        background: linear-gradient(135deg, #0a0e1a 0%, #141825 100%);
        border-color: rgba(255, 215, 0, 0.2);
    }
    
    .quote-section-enhanced {
        background: linear-gradient(135deg, 
            rgba(10, 14, 26, 0.98) 0%, 
            rgba(20, 24, 37, 0.95) 100%);
    }
    
    .quote-photo-enhanced::after {
        background: linear-gradient(45deg, 
            transparent 0%,
            rgba(255, 215, 0, 0.05) 100%);
    }
}


@media (prefers-color-scheme: light) {
    .hero-overlay {
        background: linear-gradient(135deg, 
            rgba(0, 0, 0, 0.85) 0%, 
            rgba(29, 31, 43, 0.8) 40%, 
            rgba(29, 31, 43, 0.6) 100%);
    }
    
    .gym-map-preview-large {
        background: linear-gradient(135deg, #0f1525 0%, #1a1f32 100%); 
        border-color: rgba(255, 215, 0, 0.4);
    }
    
    .zone-item-enhanced {
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    }
    
    .quote-section-enhanced {
        background: linear-gradient(135deg, 
            rgba(15, 21, 37, 0.98) 0%, 
            rgba(26, 31, 50, 0.95) 100%); 
    }
    
    .quote-text-enhanced {
        color: var(--color-white);
    }
}
</style>


<div id="notificationContainer" class="notification-container"></div>


<section class="hero">
    <div class="hero-background-image" style="background-image: url('{{ asset('storage/test.jpg') }}');"></div>
    <div class="hero-overlay"></div>

    <div class="container hero-content">
        <div class="hero-text-wrapper">
            <div class="hero-logo-title">
                <img src="/storage/ReGymSymbol.png" alt="ReGYM Logo" class="logo-img-hero">
                <span class="logo-text-hero">
                    <span class="logo-yellow">Re</span><span class="logo-white">GYM</span>
                </span>
            </div>
            
            <h1 class="hero-title fade-in">
                <span class="hero-subtitle-main">Спортивный зал №1 в Кургане</span>
            </h1>
                
            <p class="hero-subtitle fade-in">
                <strong>Лучший выбор для тех, кто ставит цели и достигает их.</strong><br>
                Только у нас: профессиональное оборудование <span class="text-accent">Technogym</span> и <span class="text-accent">Aerofit</span>, <br>тренеры-чемпионы и собственная сауна после тренировки.
            </p>
            
            <div class="hero-actions">
                <a href="#request" class="btn btn-primary">
                    Записаться
                </a>
                <a href="#about" class="btn btn-outline-light">
                    Узнать больше о зале
                </a>
            </div>
        </div>
        
        
        <div class="hero-disc-left">
            <img src="/storage/disc2.png" alt="Резиновый диск" loading="lazy">
        </div>

        <img class="hero-hero" src="/storage/hero.png" alt="Герой" loading="lazy">
        
        
        <div class="hero-disc-right">
            <img src="/storage/disc1.png" alt="Диск для штанги" loading="lazy">
        </div>
    </div>
    
    
    <div class="scroll-indicator">
        <svg viewBox="0 0 24 24">
            <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
        </svg>
    </div>
</section>


<section class="section section-bg-light" id="about">
    <div class="container">
        <h2 class="section-title fade-in">Почему выбирают <span>ReGYM</span></h2>
        <p class="section-subtitle fade-in">Мы создали пространство, где каждый элемент работает на ваш результат</p>
        
        <div class="features">
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Профессиональные тренеры</h3>
                <p>Опытные мастера с соревновательным опытом помогут достичь любых целей</p>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                    </svg>
                </div>
                <h3>Современные тренажеры</h3>
                <p>Technogym и Aerofit - лучшее оборудование для эффективных тренировок</p>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3>Гибкий график работы</h3>
                <p>Работаем 7 дней в неделю для вашего удобства</p>
            </div>
        </div>
    </div>
</section>


<section class="section section-bg-dark" id="trainers">
    <div class="container">
        <h2 class="section-title fade-in">Наши <span>тренеры</span></h2>
        <p class="section-subtitle fade-in">Профессионалы, которые помогут достичь ваших целей</p>
        
        <div class="trainers-grid">
            @foreach($trainers->take(3) as $trainer)
            <div class="trainer-card fade-in">
                @if($trainer->photo)
                <img src="{{ asset('storage/' . $trainer->photo) }}" alt="{{ $trainer->name }}" class="trainer-photo" loading="lazy">
                @else
                <div class="trainer-photo" style="background: var(--color-gray); display: flex; align-items: center; justify-content: center; font-size: 60px;">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--color-yellow)" stroke-width="1">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                @endif
                <div class="trainer-info">
                    <h3 class="trainer-name">{{ $trainer->name }}</h3>
                    <p class="trainer-specialization">{{ $trainer->specialization }}</p>
                    
                    @php
                        $sportsArray = is_array($trainer->sports) ? $trainer->sports : [];
                        if (is_string($trainer->sports) && !empty($trainer->sports)) {
                            $decoded = json_decode($trainer->sports, true);
                            $sportsArray = is_array($decoded) ? $decoded : [];
                        }
                    @endphp
                    
                    @if(!empty($sportsArray))
                    <div class="trainer-sports">
                        @foreach(array_slice($sportsArray, 0, 3) as $sport)
                        <span class="sport-tag">{{ $sport }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="trainer-action-wrapper">
                        <a href="{{ route('trainer.show', $trainer->id) }}" class="btn btn-outline" style="width: 100%;">Профиль тренера</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div style="text-align: center; margin-top: 50px;">
            <a href="{{ route('trainers') }}" class="btn btn-black" >Все тренеры</a>
        </div>
    </div>
</section>


<section class="section section-bg-light" id="services">
    <div class="container">
        <h2 class="section-title fade-in">Направления <span>тренировок</span></h2>
        <p class="section-subtitle fade-in">Выберите свой путь к совершенству</p>
        
        <div class="services-grid">
            <div class="service-card fade-in">
                <div class="service-image">
                    <img src="/storage/boxing.webp" alt="Бокс" loading="lazy">
                    <div class="service-content-basic">
                        <h3>Бокс</h3>
                    </div>
                    <div class="service-content-expanded">
                        <h3>Бокс</h3>
                        <p>Профессионально оборудованный зал для занятий боксом. Опытные тренеры помогут освоить технику и развить выносливость.</p>
                    </div>
                </div>
            </div>
            
            <div class="service-card fade-in">
                <div class="service-image">
                    <img src="/storage/armwrestling.webp" alt="Армрестлинг" loading="lazy">
                    <div class="service-content-basic">
                        <h3>Армрестлинг</h3>
                    </div>
                    <div class="service-content-expanded">
                        <h3>Армрестлинг</h3>
                        <p>Специальный стол для борьбы, профессиональные рукоятки и оборудование для качественных тренировок.</p>
                    </div>
                </div>
            </div>
            
            <div class="service-card fade-in">
                <div class="service-image">
                    <img src="/storage/gym.webp" alt="Тренажерный зал" loading="lazy">
                    <div class="service-content-basic">
                        <h3>Тренажерный зал</h3>
                    </div>
                    <div class="service-content-expanded">
                        <h3>Тренажерный зал</h3>
                        <p>Профессиональное оборудование Technogym и Aerofit для безопасных и эффективных тренировок.</p>
                    </div>
                </div>
            </div>
            
            <div class="service-card fade-in">
                <div class="service-image">
                    <img src="/storage/powerlifting.webp" alt="Пауэрлифтинг" loading="lazy">
                    <div class="service-content-basic">
                        <h3>Пауэрлифтинг</h3>
                    </div>
                    <div class="service-content-expanded">
                        <h3>Пауэрлифтинг</h3>
                        <p>Зона с жимовыми лавками, стойками для приседа и всем необходимым для силовых тренировок.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section section-bg-dark gym-map-section" id="gym-map">
    <div class="container">
        <h2 class="section-title fade-in">Интерактивная <span>планировка зала</span></h2>
        <p class="section-subtitle fade-in">Изучите расположение оборудования <br> перед визитом</p>
        
        <div class="gym-map-container fade-in">
            <div class="gym-map-preview-large">
                
                <div class="grid-background-enhanced"></div>
                
                @if(isset($zones) && count($zones) > 0)
                    @php
                        
                        $sortedZones = $zones->sortByDesc(function($zone) {
                            return $zone->width * $zone->height;
                        });
                    @endphp
                    
                    @foreach($sortedZones as $zone)
                        @php
                            
                            $zoneArea = $zone->width * $zone->height;
                            $isTiny = $zoneArea <= 4;
                            $isVeryTiny = $zoneArea <= 2;
                            
                            $zoneClass = 'zone-item-enhanced';
                            if ($isTiny) {
                                $zoneClass .= ' zone-item-tiny';
                            }
                            if ($isVeryTiny) {
                                $zoneClass .= ' zone-item-very-tiny';
                            }
                            
                            
                            $zoneColor = $zone->color ?? '#64748b';
                            
                            
                            $firstLetter = mb_substr(trim($zone->name), 0, 1);
                            
                            $firstLetter = $firstLetter ? strtoupper($firstLetter) : 'Z';
                            
                            
                            $leftPos = $zone->grid_x * (100/60);
                            $topPos = $zone->grid_y * (100/24);
                            $widthPercent = max(1.5, $zone->width) * (100/60);
                            $heightPercent = max(1.5, $zone->height) * (100/24);
                            
                            
                            $screenWidth = request()->header('X-Viewport-Width') ?? 1920;
                            $fontSize = 'clamp(8px, 1vw, 12px)';
                            
                            if ($screenWidth <= 430) {
                                if ($isVeryTiny) {
                                    $fontSize = 'clamp(4px, 0.6vw, 6px)';
                                } elseif ($isTiny) {
                                    $fontSize = 'clamp(5px, 0.7vw, 7px)';
                                } else {
                                    $fontSize = 'clamp(6px, 0.8vw, 8px)';
                                }
                            } elseif ($screenWidth <= 768) {
                                if ($isVeryTiny) {
                                    $fontSize = 'clamp(5px, 0.7vw, 7px)';
                                } elseif ($isTiny) {
                                    $fontSize = 'clamp(6px, 0.8vw, 8px)';
                                } else {
                                    $fontSize = 'clamp(7px, 0.9vw, 9px)';
                                }
                            }
                        @endphp
                        
                        <div style="
                            position: absolute;
                            left: {{ $leftPos }}%;
                            top: {{ $topPos }}%;
                            width: {{ $widthPercent }}%;
                            height: {{ $heightPercent }}%;
                            background: {{ $zoneColor }}40;
                            border: 2px solid {{ $zoneColor }};
                            font-size: {{ $fontSize }};
                        " 
                        class="{{ $zoneClass }}" 
                        data-zone-id="{{ $zone->id }}"
                        data-zone-area="{{ $zoneArea }}"
                        title="{{ $zone->name }} - {{ $zone->width }}×{{ $zone->height }} секторов">
                            
                            <div class="zone-label" title="{{ $zone->name }}">
                                {{ $firstLetter }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="
                        position: absolute;
                        inset: 0;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        color: var(--color-white);
                        font-size: 1.2rem;
                        font-weight: 500;
                        text-align: center;
                        padding: 20px;
                        background: rgba(0, 0, 0, 0.7);
                        backdrop-filter: blur(10px);
                    ">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-yellow)" stroke-width="1.5" style="margin-bottom: 20px;">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="9" y1="3" x2="9" y2="21"></line>
                            <line x1="15" y1="3" x2="15" y2="21"></line>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="3" y1="15" x2="21" y2="15"></line>
                        </svg>
                        Планировка зала в процессе наполнения
                        <p style="margin-top: 10px; font-size: 0.9rem; opacity: 0.8;">
                            Скоро здесь появятся все зоны нашего зала
                        </p>
                    </div>
                @endif
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('gym.layout') }}" class="gym-map-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Исследовать планировку зала
                </a>
            </div>
        </div>
    </div>
</section>


<section class="section section-bg-light quote-section-enhanced" id="quote">
    <div class="container">
        <div class="quote-container-enhanced fade-in">
            <div class="quote-layout-enhanced">
                
                <div class="quote-photo-wrapper">
                    
                    <div class="quote-icon-overlay">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 21v-4a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v4"></path>
                            <path d="M7 13v-4a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v4"></path>
                            <path d="M21 8V4a4 4 0 0 0-4-4h-4a4 4 0 0 0-4 4v4"></path>
                            <path d="M17 17v-4a4 4 0 0 0-4-4h-4a4 4 0 0 0-4 4v4"></path>
                        </svg>
                    </div>
                    
                    
                    <div class="quote-photo-enhanced">
                        <img src="{{ asset('storage/OlegNikolaevish.webp') }}" alt="Основатель ReGYM Олег Паклин" loading="lazy">
                    </div>
                </div>
                
                
                <div class="quote-content-enhanced">
                    <h3 class="quote-text-enhanced">
                        "Победит не тот, кто сильнее, <br> а тот, кто готов идти до конца"
                    </h3>
                    
                    <div class="quote-author-enhanced">
                        <span>Основатель ReGYM, тренер Олег Паклин</span>
                        <span class="author-badge">Мастер спорта</span>
                    </div>
                    
                    <p class="quote-description">
                        Приглашаем Вас и Ваших сотрудников стать членами спортивного клуба "reGYM" в Кургане
                    </p>
                </div>
                
                
                <div class="quote-decoration">
                    <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 0C44.8 0 0 44.8 0 100s44.8 100 100 100 100-44.8 100-100S155.2 0 100 0zm0 180c-44.2 0-80-35.8-80-80s35.8-80 80-80 80 35.8 80 80-35.8 80-80 80z" 
                        fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section section-bg-dark" id="request">
    <div class="container">
        <h2 class="section-title fade-in">Записаться на <span>пробную тренировку</span></h2>
        <p class="section-subtitle fade-in">Сделайте первый шаг к изменениям</p>
        
        <div class="form-container fade-in">
            <form id="requestForm">
                @csrf
                <input type="hidden" name="request_type" value="trial_training">
                
                <div class="form-group">
                    <label class="form-label">Тип обращения</label>
                    <select name="request_type" class="form-control" required>
                        <option value="">Выберите тип обращения</option>
                        <option value="trial_training">Пробная тренировка</option>
                        <option value="consultation">Консультация</option>
                        <option value="subscription">Абонемент</option>
                        <option value="personal_training">Персональная тренировка</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">ФИО</label>
                    <input type="text" name="full_name" class="form-control" placeholder="Введите ваше ФИО" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Телефон</label>
                    <input type="tel" name="phone" class="form-control" placeholder="+7 (___) ___-__-__" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email (необязательно)</label>
                    <input type="email" name="email" class="form-control" placeholder="example@email.com">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Сообщение (необязательно)</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Ваше сообщение..."></textarea>
                </div>
                
                <button type="submit" class="btn" style="width: 100%; padding: 15px;">Отправить заявку</button>
                
                <p style="margin-top: 20px; font-size: 14px; text-align: center; opacity: 0.7; line-height: 1.5;">
                    Отправляя данные, вы соглашаетесь с нашей Политикой конфиденциальности
                </p>
            </form>
        </div>
    </div>
</section>


<section class="section section-bg-map">
    <div class="container">
        <h2 class="section-title fade-in">Мы на <span>карте</span></h2>
        
        <div class="map-container fade-in">
            <iframe 
                src="{{ $gymSettings['map_url'] ?? 'https://yandex.ru/map-widget/v1/?um=constructor%3Ac07d2fff51c8c44018d6d187f3673b83fd2e95e443e26ccd40cb9e5d1be4de2d&amp;source=constructor' }}" 
                width="100%" 
                height="100%" 
                frameborder="0"
                style="border: none;"
                allowfullscreen
                loading="lazy"
                title="Расположение фитнес-клуба ReGYM в Кургане">
            </iframe>
        </div>
        
        <div class="contact-info fade-in">
            <p style="margin-bottom: 10px;">
                <strong>Адрес:</strong> 
                {{ $gymSettings['address'] ?? '3-й микрорайон, д. 6Б, Курган' }}
            </p>
            
            <p style="margin-bottom: 10px;">
                <strong>Телефон:</strong> 
                <a href="tel:{{ $gymSettings['phone'] ?? '+79088390808' }}" 
                style="color: var(--color-yellow); text-decoration: none;">
                    {{ $gymSettings['phone'] ?? '+7 (908) 839-08-08' }}
                </a>
            </p>
            
            @if(!empty($gymSettings['email']))
            <p style="margin-bottom: 10px;">
                <strong>Email:</strong> 
                <a href="mailto:{{ $gymSettings['email'] }}" 
                style="color: var(--color-yellow); text-decoration: none;">
                    {{ $gymSettings['email'] }}
                </a>
            </p>
            @endif
            
            <p style="margin-bottom: 15px;">
                <strong>Время работы:</strong> 
                будни {{ $gymSettings['work_hours_weekdays'] ?? '7:00-23:00'}}, <br>
                выходные {{ $gymSettings['work_hours_weekends'] ?? '9:00-21:00' }}
            </p>
            
            <p>
                <strong>Соцсети:</strong> 
                <a href="https://vk.com/sport_regym" 
                style="color: var(--color-yellow); margin: 0 10px; text-decoration:none;" 
                target="_blank" title="Группа ВКонтакте">
                    VK
                </a>
                <a href="https://t.me/regum_kurgan" 
                style="color: var(--color-yellow); margin: 0 10px; text-decoration:none;" 
                target="_blank" title="Telegram канал">
                    Telegram
                </a>
            </p>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header');
    const hero = document.querySelector('.hero');
    
    if (header && hero) {
        header.style.zIndex = '1000';
        hero.style.zIndex = '1';
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > hero.offsetHeight - 100) {
                header.style.background = 'rgba(29, 31, 43, 0.98)';
                header.style.backdropFilter = 'blur(20px)';
            } else {
                header.style.background = 'rgba(29, 31, 43, 0.95)';
            }
        });
    }
    
    
    const phoneInput = document.querySelector('input[name="phone"]');
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
    
    
    function showNotification(message, type = 'success') {
        const container = document.getElementById('notificationContainer');
        
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        
        let icon = '';
        if (type === 'success') {
            icon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>`;
        } else {
            icon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>`;
        }
        
        notification.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px;">
                ${icon}
                <span style="color: ${type === 'success' ? '#000000' : 'white'} !important; font-weight: 600;">${message}</span>
            </div>
        `;
        
        container.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
    
    
    const requestForm = document.getElementById('requestForm');
    if (requestForm) {
        requestForm.addEventListener('submit', async function(e) {
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
                    const errorDiv = document.createElement('div');
                    errorDiv.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: linear-gradient(135deg, #ef4444, #dc2626);
                        color: white;
                        padding: 20px;
                        border-radius: 8px;
                        z-index: 10000;
                        animation: fadeIn 0.3s ease-out;
                        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                        font-family: 'Inter', sans-serif;
                        font-weight: 600;
                        max-width: 300px;
                    `;
                    errorDiv.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            <span>${data.message || 'Ошибка при отправке заявки'}</span>
                        </div>
                    `;
                    document.body.appendChild(errorDiv);
                    
                    setTimeout(() => {
                        errorDiv.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => errorDiv.remove(), 300);
                    }, 5000);
                }
            } catch (error) {
                const errorDiv = document.createElement('div');
                errorDiv.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #ef4444, #dc2626);
                    color: white;
                    padding: 20px;
                    border-radius: 8px;
                    z-index: 10000;
                    animation: fadeIn 0.3s ease-out;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                    font-family: 'Inter', sans-serif;
                    font-weight: 600;
                    max-width: 300px;
                `;
                errorDiv.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <span>Ошибка сети</span>
                    </div>
                `;
                document.body.appendChild(errorDiv);
                
                setTimeout(() => {
                    errorDiv.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => errorDiv.remove(), 300);
                }, 5000);
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});
</script>
@endsection