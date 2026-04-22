class Gallery {
    constructor(container) {
        this.container = container;
        this.galleryId = container.dataset.galleryId;
        this.mainGallery = container.querySelector('.main-gallery');
        this.mainSlides = container.querySelectorAll('.main-slide img');
        this.thumbnailGallery = container.querySelector('.thumbnail-gallery');
        this.thumbnails = container.querySelectorAll('.thumbnail');
        this.galleryNav = container.querySelector('.gallery-nav');
        this.prevButton = this.galleryNav?.querySelector('.prev');
        this.nextButton = this.galleryNav?.querySelector('.next');
        this.thumbPrevButton = container.querySelector('.thumbnail-nav .prev');
        this.thumbNextButton = container.querySelector('.thumbnail-nav .next');
        this.currentSlide = 0;
        this.slideInterval = null;
        this.thumbnailPosition = 0;
        this.thumbnailWidth = 130; // thumbnail width + gap

        this.init();
    }

    init() {
        if (!this.mainSlides.length || !this.thumbnails.length) return;

        this.ensureNavButtons();
        this.setupEventListeners();
        this.showSlide(0);
        this.startSlideshow();
    }

    showSlide(index) {
        this.mainSlides.forEach(slide => slide.classList.remove('active'));
        this.thumbnails.forEach(thumb => thumb.classList.remove('active'));

        this.mainSlides[index].classList.add('active');
        this.thumbnails[index].classList.add('active');
        this.currentSlide = index;
        this.scrollThumbnailIntoView(index);
    }

    scrollThumbnailIntoView(index) {
        const newPosition = -index * this.thumbnailWidth;
        this.thumbnailPosition = Math.max(
            Math.min(newPosition, 0),
            -(this.thumbnails.length - 3) * this.thumbnailWidth
        );
        this.thumbnailGallery.style.transform = `translateX(${this.thumbnailPosition}px)`;
    }

    nextSlide() {
        let next = this.currentSlide + 1;
        if (next >= this.mainSlides.length) next = 0;
        this.showSlide(next);
    }

    prevSlide() {
        let prev = this.currentSlide - 1;
        if (prev < 0) prev = this.mainSlides.length - 1;
        this.showSlide(prev);
    }

    nextThumbnail() {
        const maxPosition = -(this.thumbnails.length - 3) * this.thumbnailWidth;
        this.thumbnailPosition = Math.max(this.thumbnailPosition - this.thumbnailWidth, maxPosition);
        this.thumbnailGallery.style.transform = `translateX(${this.thumbnailPosition}px)`;
    }

    prevThumbnail() {
        this.thumbnailPosition = Math.min(this.thumbnailPosition + this.thumbnailWidth, 0);
        this.thumbnailGallery.style.transform = `translateX(${this.thumbnailPosition}px)`;
    }

    startSlideshow() {
        this.slideInterval = setInterval(() => this.nextSlide(), 5000);
    }

    stopSlideshow() {
        clearInterval(this.slideInterval);
    }

    ensureNavButtons() {
        if (!this.galleryNav) {
            this.galleryNav = document.createElement('div');
            this.galleryNav.className = 'gallery-nav';
            this.mainGallery?.appendChild(this.galleryNav);
        }

        if (!this.prevButton) {
            this.prevButton = document.createElement('button');
            this.prevButton.className = 'nav-button prev';
            this.prevButton.innerHTML = '&#10094;';
            this.galleryNav?.appendChild(this.prevButton);
        }

        if (!this.nextButton) {
            this.nextButton = document.createElement('button');
            this.nextButton.className = 'nav-button next';
            this.nextButton.innerHTML = '&#10095;';
            this.galleryNav?.appendChild(this.nextButton);
        }
    }

    setupEventListeners() {
        this.thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                this.stopSlideshow();
                this.showSlide(index);
                this.startSlideshow();
            });
        });

        if (this.prevButton && this.nextButton) {
            this.prevButton.addEventListener('click', () => {
                this.stopSlideshow();
                this.prevSlide();
                this.startSlideshow();
            });

            this.nextButton.addEventListener('click', () => {
                this.stopSlideshow();
                this.nextSlide();
                this.startSlideshow();
            });
        }

        if (this.thumbPrevButton) {
            this.thumbPrevButton.addEventListener('click', () => this.prevThumbnail());
        }

        if (this.thumbNextButton) {
            this.thumbNextButton.addEventListener('click', () => this.nextThumbnail());
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const galleries = document.querySelectorAll('.gallery_thumbnail');
    galleries.forEach(gallery => new Gallery(gallery));
});
