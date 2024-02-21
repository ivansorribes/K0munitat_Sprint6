// resources/js/Codea.jsx
import React from "react";
import { createRoot } from "react-dom/client";
import image1 from "../../public/img/imgSobre1.png";
import image2 from "../../public/img/imgSobre3.jpg";
import image3 from "../../public/img/imgSobre4.jpeg";

export default function AboutUs() {
  return (
    <div className="relative max-w-8xl mx-auto">
      <h2 className="mb-0 lg:mb-6 font-sans text-lg lg:text-3xl text-cente lg:text-left font-bold leading-none tracking-tight text-gray-900 md:mx-auto">
        <span className="relative inline-block">
          <svg
            viewBox="0 0 52 24"
            fill="currentColor"
            className="absolute text-black -top-4 left-12 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block"
          ></svg>
          <span className="relative text-xl lg:text-3xl text-center">
            {" "}
            About Us{" "}
          </span>
        </span>
      </h2>
      <p className="pt-4 mb-10 text-gray-600">
      Welcome to K0munitat! We're thrilled to have you with us as we navigate the exciting journey of the second year of Web Application Development. In our group, we not only share classrooms and projects, but also a common vision: to build a vibrant and collaborative community that merges technology with sustainability.
      </p>
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div className="shadow-lg rounded-lg overflow-hidden">
          <img src={image1} className="h-full" />
        </div>

        <div className="shadow-lg rounded-lg overflow-hidden">
          <img src={image2} className="h-full" />
        </div>

        <div className="shadow-lg rounded-lg overflow-hidden">
          <img src={image3} className="h-full" />
        </div>
      </div>
      <p className="pt-10 text-gray-600">
      At K0munitat, we're committed to strengthening connections with nature and addressing overproduction of food and products. We believe in the power of technological innovation to drive positive changes in our society and the environment. And that's how our web application is born, a tool that goes beyond the conventional.
      </p>
      <p className="pt-4 text-gray-600">
      Imagine a platform where you can explore diverse communities in your region, each with its unique identity and shared purpose. Whether you're passionate about sustainable agriculture, want to share your crafting skills, or simply seek a space where your values find echo, K0munitat is the perfect place to connect with like-minded individuals.
      </p>
      <p className="pt-4 text-gray-600">
      Through our web application, we invite you to discover inspiring stories, participate in exciting projects, and contribute to a movement that seeks a harmonious balance between technology and sustainability. Each member is an essential piece of this growing community, and we want your voice, your experience, and your enthusiasm to add to the richness of K0munitat.
      </p>
      <p className="pt-4 text-gray-600">
      Are you ready to embark on this exciting journey with us? The adventure is just beginning, and we're thrilled to have you on board. Welcome to K0munitat, where technology meets sustainability, and community becomes the engine of positive change!
      </p>
    </div>
  );
}

if (document.getElementById("aboutus")) {
  createRoot(document.getElementById("aboutus")).render(<AboutUs />);
}
