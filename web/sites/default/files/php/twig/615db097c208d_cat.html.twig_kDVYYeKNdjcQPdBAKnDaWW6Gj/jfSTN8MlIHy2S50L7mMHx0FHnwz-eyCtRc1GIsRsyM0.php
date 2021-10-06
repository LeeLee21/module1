<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/leelee/templates/cat.html.twig */
class __TwigTemplate_712fc4121cb7db314a33201ccbddf40af289c7b2b59900768996a41703be54b8 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
  <div class=\"cats-block\">
    <div class=\"image-wrapper\">
      <div class=\"cat-image\"><a href=\"";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["image"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["#uri"] ?? null) : null), 4, $this->source)]), "html", null, true);
        echo "\" target=\"_blank\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["image"] ?? null), 4, $this->source), "html", null, true);
        echo "</a></div>
    </div>
    <div class=\"cat-name\">";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["name"] ?? null), 6, $this->source), "html", null, true);
        echo "</div>
    <div class=\"cat-email\">";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["email"] ?? null), 7, $this->source), "html", null, true);
        echo "</div>
    <div class=\"cat-timestamp\">";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["timestamp"] ?? null), 8, $this->source), "html", null, true);
        echo "</div>
    ";
        // line 9
        if (twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "hasPermission", [0 => "administer nodes"], "method", false, false, true, 9)) {
            // line 10
            echo "      <div class=\"cat-btn\">
        <div class=\"edit-cat\"><a href=\"#\" class=\"use-ajax edit-cat-btn\"><img
              src=\"/modules/custom/leelee/images/edit.png\" alt=\"edit\" class=\"edit-img\"></a></div>
        <div class=\"delete-cat\"><a href=\"/leelee/deletecat/";
            // line 13
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["id"] ?? null), 13, $this->source), "html", null, true);
            echo "\" class=\"use-ajax delete-cat-btn\" data-dialog-type=\"modal\"><img
              src=\"/modules/custom/leelee/images/delete.png\" alt=\"delete\" class=\"delete-img\"></a></div>
      </div>
    ";
        }
        // line 17
        echo "  </div>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/leelee/templates/cat.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 17,  70 => 13,  65 => 10,  63 => 9,  59 => 8,  55 => 7,  51 => 6,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
  <div class=\"cats-block\">
    <div class=\"image-wrapper\">
      <div class=\"cat-image\"><a href=\"{{ file_url(image['#uri']) }}\" target=\"_blank\">{{ image }}</a></div>
    </div>
    <div class=\"cat-name\">{{ name }}</div>
    <div class=\"cat-email\">{{ email }}</div>
    <div class=\"cat-timestamp\">{{ timestamp }}</div>
    {% if user.hasPermission('administer nodes') %}
      <div class=\"cat-btn\">
        <div class=\"edit-cat\"><a href=\"#\" class=\"use-ajax edit-cat-btn\"><img
              src=\"/modules/custom/leelee/images/edit.png\" alt=\"edit\" class=\"edit-img\"></a></div>
        <div class=\"delete-cat\"><a href=\"/leelee/deletecat/{{ id }}\" class=\"use-ajax delete-cat-btn\" data-dialog-type=\"modal\"><img
              src=\"/modules/custom/leelee/images/delete.png\" alt=\"delete\" class=\"delete-img\"></a></div>
      </div>
    {% endif %}
  </div>
", "modules/custom/leelee/templates/cat.html.twig", "/var/www/web/modules/custom/leelee/templates/cat.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 9);
        static $filters = array("escape" => 4);
        static $functions = array("file_url" => 4);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                ['file_url']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
