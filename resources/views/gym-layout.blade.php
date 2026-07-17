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


.gym-map-section {
    position: relative;
    overflow: hidden;
    padding: 80px 0;
    background: #1d1f2b;
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
    z-index: 2;
    box-shadow: 
        0 4px 12px rgba(0, 0, 0, 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(4px);
    box-sizing: border-box;
    cursor: pointer;
    transform-origin: center center;
    transition: all 0.3s ease;
    min-width: 30px;
    min-height: 30px;
}

.zone-item-enhanced:hover {
    transform: scale(1.05);
    box-shadow: 
        0 6px 20px rgba(255, 215, 0, 0.3),
        inset 0 0 0 2px var(--color-yellow);
    z-index: 10;
}

.zone-item-enhanced.active {
    transform: scale(1.05);
    box-shadow: 
        0 6px 20px rgba(255, 215, 0, 0.5),
        inset 0 0 0 2px var(--color-yellow);
    z-index: 10;
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
}

.zone-item-micro {
    min-width: 12px;
    min-height: 12px;
    font-size: 6px;
    border-radius: 3px;
    z-index: 5;
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


.zone-info-container {
    display: none;
    background: linear-gradient(135deg, #2a2d3e 0%, #1d1f2b 100%);
    border-radius: 12px;
    padding: 0;
    margin-top: 30px;
    border: 1px solid rgba(255, 215, 0, 0.2);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    width: 100%;
    min-height: 400px;
    position: relative;
    overflow: hidden;
}

.zone-info-container.active {
    display: block;
    animation: fadeIn 0.3s ease-out;
}


.zone-info-layout {
    display: flex;
    height: 100%;
    min-height: 400px;
}


.zone-info-left {
    flex: 0 0 350px;
    background: rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px;
    border-right: 2px solid rgba(255, 215, 0, 0.1);
}

.zone-info-image {
    width: 100%;
    height: 320px;
    border-radius: 10px;
    overflow: hidden;
    display: none;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.zone-info-image:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
}

.zone-info-image:hover::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 215, 0, 0.1);
    z-index: 1;
}

.zone-info-image.active {
    display: block;
}

.zone-info-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    display: block;
    transition: all 0.3s ease;
}


.zone-info-image .zoom-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 70px;
    height: 70px;
    background: rgba(0, 0, 0, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 2;
    pointer-events: none;
}

.zone-info-image:hover .zoom-icon {
    opacity: 1;
}

.zone-info-image .zoom-icon svg {
    width: 28px;
    height: 28px;
    stroke: var(--color-yellow);
    stroke-width: 2.5;
    fill: none;
}


.zone-info-right {
    flex: 1;
    padding: 30px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.zone-info-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(255, 215, 0, 0.3);
}

.zone-color-indicator {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    flex-shrink: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.zone-info-name {
    font-family: 'Oswald', sans-serif;
    font-size: 2.2rem;
    color: var(--color-white);
    font-weight: 800;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.zone-info-description {
    font-family: 'Inter', sans-serif;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    margin-bottom: 30px;
    font-size: 1.05rem;
    background: rgba(255, 255, 255, 0.05);
    padding: 25px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    flex: 1;
    min-height: 150px;
    display: flex;
    align-items: center;
}

.zone-info-area {
    background: rgba(255, 215, 0, 0.15);
    padding: 25px;
    border-radius: 10px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    text-align: center;
    box-shadow: 0 8px 20px rgba(255, 215, 0, 0.1);
}

.zone-area-label {
    font-family: 'Oswald', sans-serif;
    color: var(--color-yellow);
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.zone-area-value {
    font-family: 'Inter', sans-serif;
    color: var(--color-white);
    font-size: 2.2rem;
    font-weight: 800;
}

.zone-area-note {
    font-family: 'Inter', sans-serif;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.95rem;
    margin-top: 10px;
    font-style: italic;
}

.no-zone-selected {
    text-align: center;
    padding: 80px 20px;
    color: rgba(255, 255, 255, 0.6);
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 400px;
}

.no-zone-selected svg {
    width: 80px;
    height: 80px;
    margin-bottom: 25px;
    opacity: 0.5;
}


.image-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    opacity: 0;
    transition: opacity 0.4s ease;
    backdrop-filter: blur(10px);
}

.image-modal-overlay.active {
    display: flex;
    opacity: 1;
}

.image-modal-container {
    width: 95%;
    height: 95%;
    max-width: 1200px;
    max-height: 90vh;
    position: relative;
    display: flex;
    flex-direction: column;
    animation: modalSlideIn 0.4s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.image-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: rgba(29, 31, 43, 0.9);
    border-bottom: 2px solid var(--color-yellow);
    border-radius: 10px 10px 0 0;
}

.image-modal-title {
    font-family: 'Oswald', sans-serif;
    font-size: 1.4rem;
    color: var(--color-white);
    font-weight: 700;
    margin: 0;
}

.image-modal-close {
    background: none;
    border: none;
    color: var(--color-white);
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    width: 40px;
    height: 40px;
}

.image-modal-close:hover {
    background: rgba(255, 215, 0, 0.2);
    transform: rotate(90deg);
}

.image-modal-close svg {
    width: 24px;
    height: 24px;
    stroke: currentColor;
    stroke-width: 2.5;
}

.image-modal-content {
    flex: 1;
    overflow: hidden;
    background: #0f111a;
    border-radius: 0 0 10px 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    position: relative;
}

.image-modal-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    display: block;
    border-radius: 8px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    animation: imageZoomIn 0.5s ease-out 0.1s both;
}

@keyframes imageZoomIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.image-modal-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    border: 4px solid rgba(255, 215, 0, 0.2);
    border-top: 4px solid var(--color-yellow);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: none;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
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




@media (max-width: 1200px) {
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
    
    .zone-info-left {
        flex: 0 0 300px;
    }
    
    .zone-info-image {
        height: 280px;
    }
    
    .zone-info-name {
        font-size: 1.8rem;
    }
    
    .zone-info-description {
        font-size: 1rem;
        padding: 20px;
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
    
    
    .zone-info-layout {
        flex-direction: column;
        min-height: auto;
    }
    
    .zone-info-left {
        flex: 0 0 auto;
        width: 100%;
        padding: 25px;
        border-right: none;
        border-bottom: 2px solid rgba(255, 215, 0, 0.1);
    }
    
    .zone-info-image {
        height: 250px;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .zone-info-right {
        padding: 25px 30px;
    }
    
    .zone-info-name {
        font-size: 1.6rem;
    }
    
    .image-modal-container {
        width: 98%;
        height: 98%;
        max-height: 85vh;
    }
    
    .image-modal-title {
        font-size: 1.2rem;
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
    
    .gym-map-section {
        padding: 50px 0;
    }
    
    
    .gym-map-preview-large {
        margin: 35% auto 35%;
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

    .zone-info-container {
        margin-top: 20px;
    }
    
    .zone-info-left {
        padding: 20px;
    }
    
    .zone-info-image {
        height: 200px;
    }
    
    .zone-info-right {
        padding: 20px;
    }
    
    .zone-info-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .zone-color-indicator {
        align-self: flex-start;
    }
    
    .zone-info-name {
        font-size: 1.4rem;
    }
    
    .zone-info-description {
        font-size: 0.9rem;
        padding: 15px;
    }
    
    .zone-info-image .zoom-icon {
        width: 50px;
        height: 50px;
    }
    
    .zone-info-image .zoom-icon svg {
        width: 20px;
        height: 20px;
    }
    
    .zone-area-value {
        font-size: 1.8rem;
    }
    
    .image-modal-container {
        height: 70vh;
    }
    
    .image-modal-header {
        padding: 12px 15px;
    }
    
    .image-modal-title {
        font-size: 1.1rem;
    }
    
    .image-modal-close {
        width: 36px;
        height: 36px;
    }
    
    .image-modal-content {
        padding: 15px;
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
    
    .zone-info-left {
        padding: 15px;
    }
    
    .zone-info-image {
        height: 180px;
    }
    
    .zone-info-right {
        padding: 15px;
    }
    
    .zone-info-name {
        font-size: 1.2rem;
    }
    
    .zone-info-description {
        font-size: 0.85rem;
        padding: 12px;
    }
    
    .zone-info-image .zoom-icon {
        width: 40px;
        height: 40px;
    }
    
    .zone-info-image .zoom-icon svg {
        width: 16px;
        height: 16px;
    }
    
    .zone-area-value {
        font-size: 1.5rem;
    }
    
    .image-modal-container {
        height: 60vh;
    }
    
    .image-modal-title {
        font-size: 1rem;
    }
    
    .image-modal-close {
        width: 32px;
        height: 32px;
    }
    
    .image-modal-close svg {
        width: 20px;
        height: 20px;
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
    
    .image-modal-container {
        height: 85vh;
    }
}


@media (max-width: 430px) {
    
    .gym-map-preview-large {
        margin: 35% auto 35%;
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
                    <span class="trainers-hero-subtitle-main">Интерактивная планировка</span>
                </h1>
                    
                <p class="trainers-hero-subtitle-v2 fade-in">
                    <strong>Исследуйте наш зал до визита.</strong><br>
                    Кликайте на зоны на карте, чтобы узнать подробную информацию о каждом участке нашего фитнес-клуба. 
                    Познакомьтесь с планировкой и выберите самое удобное место для тренировок.
                </p>
                
                <div class="trainers-hero-actions fade-in delay-2">
                    <a href="#gym-map" class="btn btn-primary">
                        Изучить карту зала
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-light">
                        На главную
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <section class="section section-bg-dark gym-map-section" id="gym-map">
        <div class="container">
            <h2 class="section-title fade-in">Интерактивная <span>карта зала</span></h2>
            <p class="section-subtitle fade-in">Кликайте на зоны, чтобы узнать подробности о каждом участке</p>
            
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
                                
                                $areaInCells = $zone->width * $zone->height;
                                $areaInMeters = round($areaInCells * 0.8, 1);
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
                            data-zone-name="{{ $zone->name }}"
                            data-zone-description="{{ $zone->description ?? 'Описание отсутствует' }}"
                            data-zone-color="{{ $zoneColor }}"
                            data-zone-image="{{ $zone->image ? asset('storage/' . $zone->image) : '' }}"
                            data-zone-area="{{ $areaInMeters }}"
                            title="{{ $zone->name }}">
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
                
                
                <div class="zone-info-container" id="zone-info-container">
                    <div class="no-zone-selected" id="no-zone-selected">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="9" y1="3" x2="9" y2="21"></line>
                            <line x1="15" y1="3" x2="15" y2="21"></line>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="3" y1="15" x2="21" y2="15"></line>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <p>Выберите зону на карте, чтобы увидеть подробную информацию</p>
                    </div>
                    
                    
                    <div id="zone-info-content" style="display: none;">
                        <div class="zone-info-layout">
                            
                            <div class="zone-info-left">
                                <div class="zone-info-image" id="zone-info-image">
                                    <div class="zoom-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                                        </svg>
                                    </div>
                                    <img id="zone-image" src="" alt="">
                                </div>
                            </div>
                            
                            
                            <div class="zone-info-right">
                                <div class="zone-info-header">
                                    <div class="zone-color-indicator" id="zone-color-indicator"></div>
                                    <h3 class="zone-info-name" id="zone-info-name"></h3>
                                </div>
                                
                                <p class="zone-info-description" id="zone-info-description"></p>
                                
                                <div class="zone-info-area">
                                    <div class="zone-area-label">Площадь зоны</div>
                                    <div class="zone-area-value" id="zone-area-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <div class="image-modal-overlay" id="imageModal">
        <div class="image-modal-container">
            <div class="image-modal-header">
                <h3 class="image-modal-title" id="imageModalTitle"></h3>
                <button class="image-modal-close" id="imageModalClose">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="image-modal-content">
                <div class="image-modal-loader"></div>
                <img class="image-modal-img" id="imageModalImg" src="" alt="">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const zoneElements = document.querySelectorAll('.zone-item-enhanced');
            const zoneInfoContainer = document.getElementById('zone-info-container');
            const noZoneSelected = document.getElementById('no-zone-selected');
            const zoneInfoContent = document.getElementById('zone-info-content');
            
            const zoneColorIndicator = document.getElementById('zone-color-indicator');
            const zoneInfoName = document.getElementById('zone-info-name');
            const zoneInfoDescription = document.getElementById('zone-info-description');
            const zoneInfoImage = document.getElementById('zone-info-image');
            const zoneImage = document.getElementById('zone-image');
            const zoneAreaValue = document.getElementById('zone-area-value');
            
            const imageModal = document.getElementById('imageModal');
            const imageModalImg = document.getElementById('imageModalImg');
            const imageModalTitle = document.getElementById('imageModalTitle');
            const imageModalClose = document.getElementById('imageModalClose');
            const imageModalLoader = document.querySelector('.image-modal-loader');
            
            let activeZone = null;
            let currentImageUrl = '';
            
            function scrollToZoneInfo() {
                zoneInfoContainer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
            
            function showZoneInfo(zoneElement) {
                document.querySelectorAll('.zone-item-enhanced').forEach(el => {
                    el.classList.remove('active');
                });
                
                zoneElement.classList.add('active');
                activeZone = zoneElement;
                
                const zoneName = zoneElement.dataset.zoneName;
                const zoneDescription = zoneElement.dataset.zoneDescription;
                const zoneColor = zoneElement.dataset.zoneColor;
                const zoneImageUrl = zoneElement.dataset.zoneImage;
                const zoneArea = zoneElement.dataset.zoneArea;
                
                zoneColorIndicator.style.backgroundColor = zoneColor;
                zoneInfoName.textContent = zoneName;
                zoneInfoDescription.textContent = zoneDescription;
                
                if (zoneImageUrl) {
                    zoneImage.src = zoneImageUrl;
                    zoneImage.alt = zoneName;
                    zoneInfoImage.classList.add('active');
                    
                    zoneImage.onclick = function(e) {
                        e.stopPropagation();
                        openImageModal(zoneImageUrl, zoneName);
                    };
                    
                    zoneInfoImage.onclick = function(e) {
                        e.stopPropagation();
                        openImageModal(zoneImageUrl, zoneName);
                    };
                } else {
                    zoneInfoImage.classList.remove('active');
                    zoneImage.onclick = null;
                    zoneInfoImage.onclick = null;
                }
                
                zoneAreaValue.textContent = `${zoneArea} м²`;
                
                noZoneSelected.style.display = 'none';
                zoneInfoContent.style.display = 'block';
                zoneInfoContainer.classList.add('active');
                
                setTimeout(() => {
                    scrollToZoneInfo();
                }, 100);
            }
            
            function openImageModal(imageUrl, title) {
                currentImageUrl = imageUrl;
                
                imageModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                
                imageModalTitle.textContent = title || 'Изображение зоны';
                
                imageModalImg.style.display = 'none';
                imageModalLoader.style.display = 'block';
                
                const img = new Image();
                img.onload = function() {
                    imageModalImg.src = imageUrl;
                    imageModalImg.alt = title || 'Изображение зоны';
                    imageModalLoader.style.display = 'none';
                    imageModalImg.style.display = 'block';
                    
                    imageModalImg.style.animation = 'none';
                    setTimeout(() => {
                        imageModalImg.style.animation = 'imageZoomIn 0.5s ease-out';
                    }, 10);
                };
                
                img.onerror = function() {
                    imageModalLoader.style.display = 'none';
                    imageModalImg.src = '';
                    imageModalImg.alt = 'Изображение не загружено';
                    imageModalImg.style.display = 'block';
                    imageModalImg.innerHTML = `
                        <div style="
                            width: 100%;
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            color: #999;
                            font-family: sans-serif;
                        ">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <path d="M21 15l-5-5L5 21"></path>
                            </svg>
                            <p style="margin-top: 15px; font-size: 1.1rem;">Изображение не найдено</p>
                        </div>
                    `;
                };
                
                img.src = imageUrl;
            }
            
            function closeImageModal() {
                imageModal.classList.remove('active');
                document.body.style.overflow = '';
                
                imageModalImg.src = '';
                imageModalImg.alt = '';
                imageModalTitle.textContent = '';
            }
            
            zoneElements.forEach(zone => {
                zone.style.pointerEvents = 'auto';
                zone.style.cursor = 'pointer';
                
                zone.addEventListener('click', function(e) {
                    e.stopPropagation();
                    showZoneInfo(this);
                });
            });
            
            document.querySelector('.gym-map-preview-large').addEventListener('click', function(e) {
                if (!e.target.closest('.zone-item-enhanced')) {
                    return;
                }
            });
            
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.gym-map-preview-large') && 
                    !e.target.closest('.zone-info-container') &&
                    activeZone) {
                    
                    activeZone.classList.remove('active');
                    activeZone = null;
                    
                    noZoneSelected.style.display = 'block';
                    zoneInfoContent.style.display = 'none';
                    zoneInfoContainer.classList.remove('active');
                }
            });
            
            imageModalClose.addEventListener('click', closeImageModal);
            
            imageModal.addEventListener('click', function(e) {
                if (e.target === imageModal) {
                    closeImageModal();
                }
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && imageModal.classList.contains('active')) {
                    closeImageModal();
                }
            });
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.gym-map-container').forEach((el, index) => {
                observer.observe(el);
            });
            
            if (zoneElements.length > 0) {
                setTimeout(() => {
                    showZoneInfo(zoneElements[0]);
                }, 1000);
            }
        });
    </script>
@endsection