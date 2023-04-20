<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class CandidateLinksNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\CandidateLinks') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\CandidateLinks) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\CandidateLinks();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'self')) {
            $object->setSelf($data->{'self'});
        }
        if (property_exists($data, 'photo')) {
            $object->setPhoto($data->{'photo'});
        }
        if (property_exists($data, 'contact')) {
            $object->setContact($data->{'contact'});
        }
        if (property_exists($data, 'skills')) {
            $object->setSkills($data->{'skills'});
        }
        if (property_exists($data, 'notes')) {
            $object->setNotes($data->{'notes'});
        }
        if (property_exists($data, 'attachments')) {
            $object->setAttachments($data->{'attachments'});
        }
        if (property_exists($data, 'videos')) {
            $object->setVideos($data->{'videos'});
        }
        if (property_exists($data, 'floats')) {
            $object->setFloats($data->{'floats'});
        }
        if (property_exists($data, 'submissions')) {
            $object->setSubmissions($data->{'submissions'});
        }
        if (property_exists($data, 'applications')) {
            $object->setApplications($data->{'applications'});
        }
        if (property_exists($data, 'placements')) {
            $object->setPlacements($data->{'placements'});
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getSelf()) {
            $data->{'self'} = $object->getSelf();
        }
        if (null !== $object->getPhoto()) {
            $data->{'photo'} = $object->getPhoto();
        }
        if (null !== $object->getContact()) {
            $data->{'contact'} = $object->getContact();
        }
        if (null !== $object->getSkills()) {
            $data->{'skills'} = $object->getSkills();
        }
        if (null !== $object->getNotes()) {
            $data->{'notes'} = $object->getNotes();
        }
        if (null !== $object->getAttachments()) {
            $data->{'attachments'} = $object->getAttachments();
        }
        if (null !== $object->getVideos()) {
            $data->{'videos'} = $object->getVideos();
        }
        if (null !== $object->getFloats()) {
            $data->{'floats'} = $object->getFloats();
        }
        if (null !== $object->getSubmissions()) {
            $data->{'submissions'} = $object->getSubmissions();
        }
        if (null !== $object->getApplications()) {
            $data->{'applications'} = $object->getApplications();
        }
        if (null !== $object->getPlacements()) {
            $data->{'placements'} = $object->getPlacements();
        }

        return $data;
    }
}
