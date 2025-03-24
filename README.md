# Gomze Developments Website

## Adding Place Images to the Portfolio Gallery

To add your 100 place images to the portfolio gallery, follow these steps:

1. **Image Preparation**
   - Prepare 100 place images with consistent dimensions (recommended: 800x600px or 1200x900px)
   - Optimize images for web (compress them to reduce file size)
   - Name your images sequentially as: `place1.jpg`, `place2.jpg`, etc., up to `place100.jpg`

2. **CDN Implementation (Recommended)**
   - Upload your images to one of the following CDN services:
     - [Cloudinary](https://cloudinary.com/) - Free tier includes 25GB storage/month
     - [ImageKit](https://imagekit.io/) - Free tier includes 20GB storage/month
     - [Cloudflare Images](https://www.cloudflare.com/products/cloudflare-images/) - $5/month for 100K images
     - [Bunny CDN](https://bunny.net/pricing/) - Pay-as-you-go pricing ($0.01/GB/month)
     - [Amazon S3 + CloudFront](https://aws.amazon.com/s3/) - Enterprise solution

3. **Configure the CDN in the Code**
   - Open `portfolio-gallery.html` and locate the `cdnConfig` object
   - Update the following settings:
     ```javascript
     const cdnConfig = {
         baseUrl: 'https://your-cdn-url.com/', // Your CDN base URL
         imagePath: 'your-project-folder/', // Path to your images folder
         imageFormat: 'jpg', // Image format (jpg, png, webp)
         fallbackUrl: 'img/places/', // Local fallback directory
         useLocalFallback: true, // Whether to try local version if CDN fails
         imageOptions: '?w=800&q=80' // CDN image transformations (if supported)
     };
     ```

4. **Alternative: Local Storage**
   - If not using a CDN, upload all your images to the `img/places/` directory
   - Make sure all images are in JPEG/JPG format for best compatibility
   - Update the `placeImages` array to use local URLs:
     ```javascript
     const placeImages = Array.from({ length: 100 }, (_, i) => ({
         id: i + 1,
         src: `img/places/place${i + 1}.jpg`,
         category: 'places',
         visible: false
     }));
     ```

5. **Testing**
   - Once configured, visit your portfolio gallery page
   - Click on the "Places" filter to view your place images
   - Images will load in batches of 16 initially, with 12 more loading each time you click "Load More"

## Performance Considerations

- The site uses lazy loading, so images only load when needed
- CDN benefits:
  - Faster loading times due to distributed servers worldwide
  - Automatic image optimization and resizing
  - Reduced load on your web hosting server
  - Better scalability for large image collections
- If using a CDN that supports on-the-fly transformations (like Cloudinary or ImageKit):
  - You can store high-resolution originals and let the CDN create optimized versions
  - Thumbnail parameters can be added to the URL (as configured in `imageOptions`)
  - Full-resolution versions are loaded only when opening the modal view

## Customizing the Places Category

If you want to organize your place images into subcategories, edit the `portfolio-gallery.html` file:

1. Add more filter buttons in the filter section
2. Modify the `placeImages` array in the JavaScript to include subcategories
3. Update the filter logic to handle your subcategories 

## CDN Implementation Guide

### Cloudinary Setup (Recommended)
1. Create a free account at [cloudinary.com](https://cloudinary.com/)
2. Upload your images using their Media Library dashboard
3. Set your `cdnConfig` to:
   ```javascript
   const cdnConfig = {
       baseUrl: 'https://res.cloudinary.com/your-cloud-name/image/upload/',
       imagePath: 'places/',
       imageFormat: 'jpg',
       fallbackUrl: 'img/places/',
       useLocalFallback: true,
       imageOptions: 'c_scale,w_800,q_auto' // Cloudinary transformation parameters
   };
   ```

### ImageKit Setup
1. Create a free account at [imagekit.io](https://imagekit.io/)
2. Upload your images using their dashboard
3. Set your `cdnConfig` to:
   ```javascript
   const cdnConfig = {
       baseUrl: 'https://ik.imagekit.io/your-account/',
       imagePath: 'places/',
       imageFormat: 'jpg',
       fallbackUrl: 'img/places/',
       useLocalFallback: true,
       imageOptions: 'tr:w-800,q-80' // ImageKit transformation parameters
   };
   ``` 