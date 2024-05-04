import React from "react";

const ToggleButton = ({ onToggle, checked, text }) => {
  const handleToggle = () => {
    onToggle(!checked); // Invierte el estado actual
  };

  return (
    <label className="inline-flex items-center cursor-pointer">
      <input
        type="checkbox"
        className="sr-only peer"
        checked={checked}
        onChange={handleToggle} // Usa handleToggle en lugar de onToggle directamente
      />
      <div
        className={`relative w-11 h-6 bg-neutral rounded-full peer peer-focus:ring-4 peer-focus:ring-secondary dark:peer-focus:ring-secondary ${
          checked ? "peer-checked:bg-primary" : ""
        }`}
      >
        <span
          className={`after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 ${
            checked ? "after:translate-x-full rtl:after:-translate-x-full" : ""
          }`}
        ></span>
      </div>
      <span className="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
        {text}
      </span>{" "}
      {/* Usar el texto pasado como propiedad */}
    </label>
  );
};

export default ToggleButton;
