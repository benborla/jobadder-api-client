<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SubmitEmploymentModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\SubmitEmploymentModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\SubmitEmploymentModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\SubmitEmploymentModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'current')) {
            $object->setCurrent($this->serializer->deserialize($data->{'current'}, 'BenBorla\\JobAdder\\V2\\Model\\SubmitCurrentEmploymentModel', 'raw', $context));
        }
        if (property_exists($data, 'ideal')) {
            $object->setIdeal($this->serializer->deserialize($data->{'ideal'}, 'BenBorla\\JobAdder\\V2\\Model\\SubmitIdealEmploymentModel', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getCurrent()) {
            $data->{'current'} = $this->serializer->serialize($object->getCurrent(), 'raw', $context);
        }
        if (null !== $object->getIdeal()) {
            $data->{'ideal'} = $this->serializer->serialize($object->getIdeal(), 'raw', $context);
        }

        return $data;
    }
}
